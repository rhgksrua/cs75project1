cs75project1
============

CS75 Finance

❑   Your  site  must  require  that  a  user  log  in  with  a  username  and  password  in  order  to  see  or  do 
anything  (except,  obviously,  log  in  or  register). 
☑   Your  site  must  allow  a  user  to  register  for  an  account.   A  user’s  username  must  be  a 
syntactically  valid  email  address. 2    A  user’s  password  must  be  at  least  six  characters,  and  it 
cannot  be  entirely  alphabetic  or  entirely  numeric.   Upon  registering,  a  user  should  receive  a 
free  gift:  $10,000  in  cash.   
☑   Your  site  must  allow  a  user  to  get  a  quote  (i.e.,  look  up  its  “Last  Trade”  price)  for  a  stock  by 
providing  its  symbol. 
☑   Your  site  must  allow  a  user  to  buy  shares  of  a  stock  by  providing  its  symbol;  your  site  must 
allow  a  user  to  buy  more  shares  of  a  stock  that  he  or  she  already  owns.   A  user  may  not  buy 
fractions  of  shares.
☑   Your  site  must  allow  a  user  to  sell  shares  of  a  stock  that  he  or  she  already  owns;  for 
simplicity,  you  may  require  that  a  user  sell  all  or  none  rather  than  some.   A  user  may  not  sell 
fractions  of  shares. 
☑   Your  site  must  allow  a  user  to  check  the  current  value  of  his  or  her  portfolio  (i.e.,  his  or  her 
cash  plus  his  or  her  stocks’  value  based  on  its  “Last  Trade”  price). 
☑   Your  site  must  perform  client-­‐side  validation,  where  possible,  of  user  input  related  to  a  buy 
or  a  sell.   For  instance,  if  some  text  field  must  contain  a  non-­‐negative  integer  (e.g.,  number 
of  shares  to  buy  or  sell),  you  must  reject  attempts  to  submit  invalid  input  (as  by admonishing  the  user  with  an  alert)  or  prevent  them  from  typing  anything  non-­‐numeric  
at  all. 
☑   On  any  page  designed  to  take  user  input,  you  should  give  focus  (via  JavaScript)  to  the  first 
field  requiring  the  user’s  attention  (e.g.,  the  username  field  on  your  login  page). 
☑   Your  site  must  perform  rigorous  server-­‐side  error-­‐checking.   Under  no  circumstances  should 
we  be  able  to  crash  your  site  or  induce  unreasonable  behavior.   Letting  us  sell  more  shares 
than  we  own  is  not,  shall  we  say,  reasonable.   We  will  bang  on  your  code  and  try  to  find 
faults;  do  not  let  us  succeed.

Technical  Requirements. 
☑   You’re  welcome  to  develop  your  site  on  any  computer  using  any  IDE  or  text  editor,  even 
without  using  the  CS50  Appliance,  but  you  must  ultimately  ensure  that  it  works  within  the 
CS50  Appliance  at  a  URL  of   http://project1/  when  installed  in 
/home/jharvard/vhosts/project1/ . 
☑   Only  files  that  should  be  web-­‐accessible  should  live  in   project1/html/ ;  everything  else 
should  live  in   project1/  or  some  (other)  subdirectory  therein. 
☑   You  must  store  users’  data  in  a  MySQL  database  (which  you  can  create  within  the  CS50 
Appliance  via  phpMyAdmin). 
☑   You  must  use  PHP’s  PDO  library  to  talk  to  MySQL  (not  PHP’s   mysql_  functions).   See 
http://www.phpro.org/tutorials/Introduction-to-PHP-PDO.html  for  reference. 
☑   Your  site  must  pull  its  real-­‐time  data  (prices,  etc.)  from  Yahoo!  Finance  by  parsing  its  CSVs; 
you  may  find   http://us3.php.net/fgetcsv  of  interest. 
☑   Your  database  tables  must  have  constraints  and  indexes  defined  where  appropriate. 
☑   You  must  avoid  race  conditions  by  using  SQL  transactions  or  locks. 
☑   You  should  avoid  inefficiencies  and  redundancies  in  your  database  tables  (e.g.,  by  keeping 
them  in  third  normal  form). 
☑   You  should  avoid  redundant  HTML;  factor  out  markup  common  to  multiple  pages  using  PHP 
functions  or  “templates”  (i.e.,  PHP  files  that  you   require  in  others). 
☑   Your  markup  language  should  be  valid  (or  “tentatively”  valid)  HTML5,  as  per 
http://validator.w3.org/ ,  unless  some  feature  of  your  site  requires  otherwise  (for 
the  sake  of  some  browser);  explain  in  HTML  comments  any  intentional  invalidities.   Your 
HTML  should  also  be  as  pretty-­‐printed  as  possible.   Your  CSS  need  not  be  valid. 
☑   Your  PHP  must  be  extensively  commented  and  be  as  pretty-­‐printed  as  possible. 
☑   You  may  use  a  WYSIWYG  editor  to  generate  HTML  and/or  CSS  that  you  would  like  to  use  in 
your  site. 
☑   If  you  integrate  third-­‐party  CSS  or  JavaScript  libraries  into  your  project,  cite  their  origin  with 
comments. 
☑   If  you  incorporate  or  adapt  snippets  of  PHP  code  from  the  Web  into  your  project  
(e.g.,  examples  from   php.net ),  cite  the  code’s  origins  with  comments. 

If  you  incorporate  images  from  the  Web  into  your  project,  cite  the  images’  with  comments. 
☑   Your  website  must  appear  and  behave  the  same  on  the  latest  versions  of  at  least  two  of 
these  browsers: 
  ☑  Chrome 
  ☑  Firefox 
  ☑  Internet  Explorer 
  ☑  Opera 
  ☑  Safari 
