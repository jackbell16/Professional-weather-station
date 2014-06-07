Select Temperature,Time
From Data
Where Temperature = (Select Max(Temperature)
					From Data
					WHERE Date = Current_Date()
					)
Group by (Temperature)