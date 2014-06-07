/*
This code allow Arduino to send the value of temperature and humidity to a DB, everty portion of time, setted by the user.
The data of temperature come from an Arduino via wireless, so one Arduino can stay outside, and the other
one can stay in the home
Version 1.0
Author Giacomo Bellazzi
 Copyright (C) 2014  Giacomo Bellazzi (http://ismanettoneblog.altervista.org/)
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
*/
#include <SPI.h>
#include <Ethernet.h>
#include <sha1.h>
#include <mysql.h>
#include <avr/dtostrf.h> 
#include <DataCoder.h>
#include <VirtualWire.h>

const int rx_pin = 11; // the Pin of the RX 
const int baudRate = 800;
byte mac_addr[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
IPAddress server_addr(192,168,1,20); // MySQL Server IP
char user[] = "username";
char password[] = "password";
Connector my_conn;        // The Connector/Arduino reference
const char INSERT_DATA[] = "INSERT INTO WeatherStation.Data VALUES (1,%s,%s,CURRENT_DATE,CURRENT_TIME)";

void setup(){
  Ethernet.begin(mac_addr);
  //Serial.begin(9600);
  Serial.println("Connecting...");
  SetupRFDataRxnLink(rx_pin, baudRate);
  if (my_conn.mysql_connect(server_addr, 3306, user, password)) {
    delay(1000);
  }
  else
    Serial.println("Connection failed.");
}

void loop(){
  uint8_t buf[VW_MAX_MESSAGE_LEN];
  uint8_t buflen = VW_MAX_MESSAGE_LEN;
  union RFData inDataSeq;//To store incoming data
  float inArray[2];//To store decoded information
  if(RFLinkDataAvailable(buf, &buflen))
  {
        for(int i =0; i< buflen; i++)
        {
          inDataSeq.s[i] = buf[i];
        }
        DecodeRFData(inArray, inDataSeq);
        float temperature = inArray[0];
        float humidity = inArray[1];
        //Serial.println("Temperature: ");
        //Serial.print(temperature);
        //Serial.print(" ° Humidity: ");
        //Serial.println(humidity);
        sendToDB(inArray[0],inArray[1]);
  }   
}
// This code send the values of the temperature and humidity to the DB
void sendToDB(float temperature,float humidity){
  char query[64];
  char t[6];
  char h[6];
  dtostrf(temperature, 1, 2, t);
  dtostrf(humidity, 1, 2, h);
  sprintf(query, INSERT_DATA, t,h);
  my_conn.cmd_query(query);
}


