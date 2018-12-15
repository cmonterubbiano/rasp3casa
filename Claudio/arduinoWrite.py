import serial
import commands
import subprocess
import sys

total = len(sys.argv)
cmdargs = str(sys.argv)
print ("The total numbers of args passed to the script: %d " % total)
print ("1Args list: %s " % cmdargs) 
if total > 1:
	(status, result) = commands.getstatusoutput('php /var/www/html/Claudio/searchArduinoUSBdevice.php')
	lookForRightUsb = '/dev/'+ str(result)
	ser = serial.Serial(str(lookForRightUsb), 9600)
	cmdargs = str(sys.argv[1])
#input = "arduini|camera_ospiti|temperatura|33.34"
#ser.write(input + '\r\n')
	ser.write(cmdargs + '\r')
	ser.close()
	print ("ESEGUITO") 

	
