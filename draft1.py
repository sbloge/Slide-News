#!/usr/bin/env python3

import os
import pdf2image
import glob
import time

base_dir = os.path.abspath(os.path.dirname(__file__))

imglist = []

old = glob.glob(os.path.join(base_dir,"imgs","*"))

imgs = pdf2image.convert_from_path(os.path.join(base_dir,"uploads","test.pdf"))

def search():
    for x in range(len(filelist)):
        y=x-1
        imgstring = ("<img src='imgs/"+filelist[x]+"'>")

        imglist.append(imgstring)
    return imglist

for f in old:
	os.remove(f)

for i in range(len(imgs)):
    imgs[i].save(os.path.join(base_dir,"imgs",'page'+str(i)+'.jpg'), 'JPEG')

filelist = [f for f in os.listdir(os.path.join(base_dir,"imgs")) if os.path.isfile(os.path.join(os.path.join(base_dir,"imgs", f)))]

filelist.sort()

search()

nlimg = str("\n".join(imglist))

message = """
    <html lang="sv">
        <head>
            <link rel="stylesheet" href="css.css">
            <meta charset="utf-8">
	    <meta http-equiv="refresh" content="600">
            <title>Bildspel</title>
        </head>
        <body>
            <div class="content">
                <div class="images">
    {img}
                </div>
            </div>
            <script src="Slide.js"></script>
        </body>
    </html>
    """

new_message = message.format(img=nlimg)

print(new_message)
