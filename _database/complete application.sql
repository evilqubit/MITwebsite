 -- contact info for  complete application
  select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 2 and app.ID < 5000
  limit 5000;
   
   
     select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 2 and app.ID < 10000 and app.ID > 5000
  limit 5000   ;
  
  
  
     select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 2 and app.ID > 10000 and   app.ID <12000
  limit 5000;
  
  
     select * from tblcontactinfo info 
 left join tblapplicationcontacts appcon on appcon.ContactID = info.ID
  left join tblapplication app on app.ID= appcon.ApplicationID
  
  where app.status = 2 and   app.ID >12000
  limit 5000
   