-- incomplete applications
           select * from tblapplicationusers appusr
        left join tblapplication app on app.ID= appusr.ApplicationID
 
          where app.status = 1  limit 16000