 -- contact info for  complete application
  select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 2 
  limit 10000