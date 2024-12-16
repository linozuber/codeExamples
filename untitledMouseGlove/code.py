import time
import digitalio
import analogio
import board

import busio

import usb_hid

from adafruit_hid.mouse import Mouse
from adafruit_mpu6050 import MPU6050

from math import sin, cos
 
#connect mpu
i2c = busio.I2C(board.GP3, board.GP2)  # uses board.SCL and board.SDA
mpu = MPU6050(i2c)


#make mouse
m = Mouse(usb_hid.devices)

angley = 0
delta = 0
last_monotonic = 0

#define input pins
lmb = digitalio.DigitalInOut(board.GP10)
rmb = digitalio.DigitalInOut(board.GP11)
mmb = digitalio.DigitalInOut(board.GP12)
spd = analogio.AnalogIn(board.A0)

lmb.pull = digitalio.Pull.DOWN
rmb.pull = digitalio.Pull.DOWN
mmb.pull = digitalio.Pull.DOWN

#trash variables
lmbd = 0
rmbd = 0
mmbd = 0

def examples():
    print(spd.value)
    m.move(100, 100, 0)
    lmp.value = True

while True:
    
    gx, gy, gz = mpu.gyro
    ax, ay, az = mpu.acceleration
  
    delta = time.monotonic() - last_monotonic
    last_momotonic = time.monotonic()

    factor = spd.value/1000
    
    mx = int(-1*(mpu.gyro[0]*ax/10+mpu.gyro[2]*az/10)*2*factor)
    my = int(-1*(mpu.gyro[0]*az/10-mpu.gyro[2]*ax/10)*factor)


    m.move(mx, my)
    
    #lmb
    if lmb.value == 1:
        if lmbd == 0:
            m.press(Mouse.LEFT_BUTTON)
        lmbd += 1
    else:
        if lmbd > 1:
            m.release(Mouse.LEFT_BUTTON)
        lmbd = 0
    #rmb
    if rmb.value == 1:
        if rmbd == 0:
            m.press(Mouse.RIGHT_BUTTON)
        rmbd += 1
    else:
        if rmbd > 1:
            m.release(Mouse.RIGHT_BUTTON)
        rmbd = 0
    #mmb
    if mmb.value == 1:
        if mmbd == 0:
            m.press(Mouse.MIDDLE_BUTTON)
        mmbd += 1
    else:
        if mmbd > 1:
            m.release(Mouse.MIDDLE_BUTTON)
        mmbd = 0

print("---\n---\nthe end\n---\n---")
