insert into accessrights(accesslevel) values(1);
insert into accessrights(accesslevel) values(2);
insert into accessrights(accesslevel) values(3);
insert into accessrights(accesslevel) values(4);

insert into UserType(AccessRightsID, Role) values(1,'Receptionist');
insert into UserType(AccessRightsID, Role) values(2,'Therapist');
insert into UserType(AccessRightsID, Role) values(2,'Doctor');
insert into UserType(AccessRightsID, Role) values(2,'Nurse');
insert into UserType(AccessRightsID, Role) values(3,'Trainer');
insert into UserType(AccessRightsID, Role) values(4,'Patient');

insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(1,'Julie', 'Lemoyne', '5153430343', 26);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(1,'Marc', 'Gagnon', '5143788732', 22);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(2,'Nancy', 'Chatlin', '4502228867', 33);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(2,'Luc', 'Gosselin', '4388343482', 29);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(3,'Forest', 'Gump', '4502832936', 48);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(3,'Morgan', 'Reilly', '4812342896', 26);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(4,'Vanessa', 'Lemay', '5149909876', 22);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(4,'Myriam', 'Brisebois', '5148340274', 25);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(5,'Amelie', 'Moreau', '4389992246', 38);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(5,'Tyler', 'Johnson', '5148761234', 24);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(6,'Vanessa', 'Lau', '5142469752', 22);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(6,'Marc', 'Broweisky', '4508863428', 41);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(6,'Jean', 'Luc', '5142489012', 38);
insert into Users(UserTypeID, First_Name, Last_Name, Phone_Number, Age) values(6,'Yasmin', 'Jelani', '4502165642', 19);

insert into Equipment(Name) values('Dumbell');
insert into Equipment(Name) values('Bycicle');
insert into Equipment(Name) values('Jump Rope');
insert into Equipment(Name) values('Foam roller');

insert into Treatment(TreatmentDescription, Cost) values('Shoulder readjustment', 89.99);
insert into Treatment(TreatmentDescription, Cost) values('Deep tissue massage', 99.99);
insert into Treatment(TreatmentDescription, Cost) values('acuponcture', 119.99);
insert into Treatment(TreatmentDescription, Cost) values('Patellar tendon massage', 49.99);

insert into Diagnosis(DiagnosisDescription) values('Inflated patellar tendon');
insert into Diagnosis(DiagnosisDescription) values('General pain or discomfort');
insert into Diagnosis(DiagnosisDescription) values('Muscle strain');
insert into Diagnosis(DiagnosisDescription) values('Dislocated shoulder');

insert into Diagnosis_Treatment values(1,4);
insert into Diagnosis_Treatment values(2,3);
insert into Diagnosis_Treatment values(3,2);
insert into Diagnosis_Treatment values(4,1);

insert into Center(Name, PhoneNumber, Address) values('BSPC Brossard', 4506562130, '6000 Boulevard Rome #300, Brossard, Qc J4Y0B6');
insert into Center(Name, PhoneNumber, Address) values('BSPC Saint-Laurent', 5142282348, '3131 Boulevard de la Cote-Vertu Suite 35, Saint-Laurent, Quebec H4R1Y8');