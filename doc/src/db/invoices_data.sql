use invoices;

insert into administrator values(null,'Administrator',sha2('Invoices2019',256),'administrator@gmail.com');

insert into user values
(null,"PeterCatania",sha2('Password&1',256),'petercat721@gmail.com', 0),
(null,"Giacomo2000",sha2('Password&1',256),'gicaomo@gmail.com', 0),
(null,"RobertoMand",sha2('Password&1',256),'ro.mand@gmail.com', 1),
(null,"SherryHaibara",sha2('Password&1',256),'ai.home@gmail.com', 1);