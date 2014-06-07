#include "DataCoder.h"
#include "VirtualWire.h"
#include "DHT.h"
#define DHTPIN 2 
#define DHTTYPE DHT22

int transmit_pin = 12;
int led_pin = 13;
int baudRate = 800;
int delayTime = 30000;

DHT dht(DHTPIN, DHTTYPE);

void setup()
{
  pinMode(led_pin,OUTPUT);
  Serial.begin(9600);
  SetupRFDataTxnLink(transmit_pin, baudRate);
  dht.begin();
}

void loop()
{
  float outArray[2];
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  outArray[0] = t;
  outArray[1] = h;
  union RFData outDataSeq;
  EncodeRFData(outArray, outDataSeq); 
  TransmitRFData(outDataSeq);  
  delay(delayTime);
}


