#include <SoftwareSerial.h>
#include <LiquidCrystal.h>

#define buzz 9  //declare buzzer pin
#define human 4 //declare pulse sensor button pin
#define temp_adjust 525  //calibration temperature sensor

SoftwareSerial gsm(3, 2);  //declare gsm module pin config
LiquidCrystal lcd(12, 11, 13, A3, A4, A5);  //declare lcd pin config

//variables declaration
int smoke_adc, temp_adc, pulse_adc, x = 0;
int timer = 0;

void setup() {
  gsm.begin(9600);  //start gsm module at 9600bps
  Serial.begin(9600);
  lcd.begin(16, 2);  //start 16 char, 2 line lcd

  pinMode(buzz, OUTPUT);  //set buzzer pin output
  digitalWrite(buzz, 0);
  pinMode(human, INPUT_PULLUP);  //set buzzer pin input

  GSM_init();  //call gsm initialization function
}

void loop() {  //repeated loop
  read_sensor();

  // show all sensor data to LCD.
  lcd.setCursor(0,0);
  lcd.print((String)"Smoke: " + smoke_adc + "%  ");

  lcd.setCursor(11,0);
  lcd.print((String)temp_adc + (char)223 + "F  ");

  lcd.setCursor(0,1);
  lcd.print((String)"Pulse: " + pulse_adc + " BPM   ");
  
  send2Server();
}

void read_sensor(){  //sensor read function
  temp_adc = analogRead(A1);  //read temperature sensor
  smoke_adc = analogRead(A0); //read smoke sensor
  if(digitalRead(human) == LOW) { //when pulse button pressed, read sensor 
    pulse_adc = analogRead(A2); //read pulse sensor
    pulse_adc = abs(map(pulse_adc, 400, 600, 40, 120));  //calibration pulse sensor
  }
  else pulse_adc = 0;
  
  // calibration temperature sensor
  temp_adc = 1023 - temp_adc;  
  temp_adc -= temp_adjust;
  if(temp_adc < 90) temp_adc = 0;

  // calibration smoke sensor
  smoke_adc = map(smoke_adc, 0, 250, 0, 100);
  if(smoke_adc < 0) smoke_adc = 0;
 
  // buzzer action
  if(temp_adc > 103) digitalWrite(buzz, HIGH);
  else if(smoke_adc > 60) digitalWrite(buzz, HIGH);
  else if(pulse_adc > 100) digitalWrite(buzz, HIGH);
  else digitalWrite(buzz, LOW);
}

void GSM_init(){  //GSM initialization function, calls once when device start
  lcd.print("Connecting GSM..");
  delay(15000);
  gsm.println("AT");
  delay(100);
  gsm.println("ATE0");
  delay(100);
  gsm.println("AT+CGATT=1");
  delay(100);
  gsm.println((String)"AT+SAPBR=3,1," + (char)34 + "CONTYPE" + (char)34 + "," + (char)34 + "GPRS" + (char)34); 
  delay(100);
  gsm.println("AT+SAPBR=1,1"); 
  delay(100);
  gsm.println("AT+HTTPINIT"); 
  delay(3000);
  lcd.clear();
}

void send2Server(){  // send data to server within 5sec.                               
  gsm.println((String)"AT+HTTPPARA=" + (char)34 + "URL" + (char)34 + "," + (char)34 + "http://iothealthcare.000webhostapp.com/connect.php?g_value=" + smoke_adc + "&t_value=" + temp_adc + "&p_value=" + pulse_adc + (char)34);
  delay(2000);
  gsm.println("AT+HTTPACTION=0");
  delay(3500);
}
