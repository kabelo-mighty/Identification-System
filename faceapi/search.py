#!C:\python/python.exe
import os
import pathlib
import cgi
from base64 import b64decode
from cgitb import html
from click import echo
import face_recognition
formData = cgi.FieldStorage()
face_match=0







image=formData.getvalue("current_image")
idno=formData.getvalue("idno")
data_uri = image
header, encoded = data_uri.split(",", 1)
data = b64decode(encoded)

with open("image.png", "wb") as f:
    f.write(data)


   

print("Content-Type: text/html")
print()
   
file_exists = os.path.exists("person_face_id/"+idno+".jpg")


try:
    
    if(file_exists):
      got_image = face_recognition.load_image_file("image.png")
      existing_image = face_recognition.load_image_file("person_face_id/"+idno+".jpg")

      got_image_facialfeatures = face_recognition.face_encodings(got_image)[0]

      existing_image_facialfeatures = face_recognition.face_encodings(existing_image)[0]

      results= face_recognition.compare_faces([existing_image_facialfeatures],got_image_facialfeatures)

      if(results[0]):
        face_match=1
      else:
        face_match=0
   


      if(face_match==1):
        print("<script>alert('Information Retrieved');window.location = 'information.php?edt="+idno+"'</script>;</script>")

      else:
        print("<script>alert('face not recognized');window.location = 'face.php';</script>")
    else:
        print("<script>alert('face not found');window.location = 'face.php';</script>") 
except (IndexError, ValueError):
        print("<script>alert('try again,request took long to fetch results');window.location = 'face.php';</script>")
 

   