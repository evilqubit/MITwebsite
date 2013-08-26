-- incomplete applications
  --         select * from tblapplicationusers appusr
  --         left join tblapplication app on app.ID= appusr.ApplicationID
 
  --         where app.status = 1  limit 16000
 
 
 -- contact info for inccomplete application
  select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 1 
  limit 10000
 
 
