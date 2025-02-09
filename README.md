# Remote Health Monitoring System  

## Description  
IoT-based system for real-time health monitoring using smoke, temperature, and pulse sensors. Collects data via an Arduino-powered device, displays metrics on an LCD, and transmits results to a remote server via GSM for remote analysis. Designed for emergency alerts using threshold-based buzzer activation.  

---

## Features  
- **Smoke Detection**: MQ-2 sensor (analog).  
- **Body Temperature Monitoring**: LM35 sensor (calibrated).  
- **Pulse Measurement**: Optical pulse sensor with button activation.  
- **Alerts**: Buzzer triggers for abnormal temperature (>103°F), high smoke levels (>60%), or elevated pulse (>100 BPM).  
- **GSM Integration**: Sends data to a web server for remote access.  

---

## Hardware Pin Configuration  
| Component      | Arduino Pin | Notes                          |  
|----------------|-------------|--------------------------------|  
| Buzzer         | 9           | Active high (5V)              |  
| Pulse Sensor   | 4           | Input with internal pull-up   |  
| LCD (16x2)     | 12, 11, 13, A3, A4, A5 | RS, EN, D4-D7            |  
| GSM Module     | 3 (RX), 2 (TX) | SoftwareSerial communication |  
| Smoke Sensor   | A0          | MQ-2 analog output            |  
| Temp Sensor    | A1          | LM35 analog output            |  
| Pulse ADC      | A2          | Optical sensor analog read    |  

**Note**: Pin assignments may vary slightly depending on wiring adjustments. Refer to schematics for specific setups.  

---

## Code Overview  
### `healthcare.ino`  
1. **Setup**:  
   - Initializes GSM module, LCD, and sensors.  
   - Configures buzzer and pulse sensor pins.  
   - Establishes GPRS connectivity via `GSM_init()`.  

2. **Main Loop**:  
   - Reads sensor values using `read_sensor()`.  
   - Displays data on LCD (smoke %, temperature °F, pulse BPM).  
   - Transmits data to a remote server every 5 seconds via `send2Server()`.  

3. **Sensor Calibration**:  
   - **Temperature**: Adjusted using `temp_adjust` offset.  
   - **Pulse**: Mapped from analog ADC range (400-600) to BPM (40-120).  
   - **Smoke**: Scaled from raw ADC (0-250) to percentage (0-100%).  

4. **Alerts**:  
   - Buzzer activates if any sensor exceeds safety thresholds.  

---

## Dependencies  
- **Libraries**:  
  - `SoftwareSerial` (GSM communication).  
  - `LiquidCrystal` (LCD interface).  

---

## Notes  
- **Server Integration**: Data is sent to `http://iothealthcare.000webhostapp.com/connect.php` with query parameters for smoke, temperature, and pulse values.  
- **Calibration**: Adjust `temp_adjust` or pulse mapping values based on hardware testing.  
- **Safety**: Triggers are experimental—verify thresholds for clinical accuracy.
