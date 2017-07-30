CREATE TABLE User(
    UserID INT(8) UNSIGNED AUTO_INCREMENT,
	UserTypeID INT(8) UNSIGNED,
	Username VARCHAR(30),
	Password VARCHAR(95),
	First_Name VARCHAR(30),
	Last_Name VARCHAR(30),
	Phone_Number VARCHAR(10),
    Age INT(3) UNSIGNED,
    PRIMARY KEY(UserID),
	CHECK (Age>=18)
);
     
CREATE TABLE Experience(
	ExperienceID INT(8) UNSIGNED AUTO_INCREMENT,
    UserID INT(8) UNSIGNED,
    PRIMARY KEY(ExperienceID)
);	
 
CREATE TABLE UserType(
	UserTypeID INT(8) UNSIGNED AUTO_INCREMENT,
    AccessRightsID INT(8) UNSIGNED,
	Role VARCHAR(30),
    PRIMARY KEY(UserTypeID)
);	

CREATE TABLE AccessRights(
    AccessRightsID INT(8) UNSIGNED AUTO_INCREMENT,
	Name VARCHAR(30),
    AccessLevel INT(2),
    PRIMARY KEY(AccessRightsID)
);

ALTER TABLE UserType 
    ADD CONSTRAINT FK_AccessRights_UserType
    FOREIGN KEY(AccessRightsID)
    REFERENCES AccessRights(AccessRightsID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
	
ALTER TABLE User 
    ADD CONSTRAINT FK_UserType_User
    FOREIGN KEY(UserTypeID)
    REFERENCES UserType(UserTypeID);
	
ALTER TABLE Experience 
    ADD CONSTRAINT FK_User_Experience
    FOREIGN KEY(UserId)
    REFERENCES User(UserID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
	
CREATE TABLE Treatment(
    TreatmentID INT(8) UNSIGNED AUTO_INCREMENT,
    Description VARCHAR(50),
	Cost DOUBLE(10,2),
    PRIMARY KEY(TreatmentID)
);

CREATE TABLE Diagnosis(
    DiagnosisID INT(8) UNSIGNED AUTO_INCREMENT,
    Description VARCHAR(50),
    PRIMARY KEY(DiagnosisID)
);

CREATE TABLE Diagnosis_Treatment(
	DiagnosisID INT(8) UNSIGNED,
	TreatmentID INT(8) UNSIGNED,
    PRIMARY KEY(DiagnosisID, TreatmentID)
);

ALTER TABLE Diagnosis_Treatment 
    ADD CONSTRAINT FK_Diagnosis_Treatment
    FOREIGN KEY(DiagnosisID)
    REFERENCES Diagnosis(DiagnosisID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
 
ALTER TABLE Diagnosis_Treatment 
    ADD CONSTRAINT FK_Treatment_Diagnosis
    FOREIGN KEY(TreatmentID)
    REFERENCES Treatment(TreatmentID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

CREATE TABLE Equipment(
    EquipmentID INT(8) UNSIGNED AUTO_INCREMENT,
    Name VARCHAR(30),
    PRIMARY KEY(EquipmentID)
);

CREATE TABLE Prescription(
    PrescriptionID INT(8) UNSIGNED AUTO_INCREMENT,
	EquipmentID INT(8) UNSIGNED,
	PatientID INT(8) UNSIGNED,
	TherapistID INT(8) UNSIGNED,
    PRIMARY KEY(PrescriptionID)
);

ALTER TABLE Prescription
    ADD CONSTRAINT Prescription
    FOREIGN KEY(EquipmentID)
    REFERENCES Equipment(EquipmentID);
 
/*Review two foreign keys go to the same table*/ 
ALTER TABLE Prescription 
    ADD CONSTRAINT FK_Patient_Prescription
    FOREIGN KEY(PatientID)
    REFERENCES User(UserID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

/*Review two foreign keys go to the same table*/ 
ALTER TABLE Prescription 
    ADD CONSTRAINT FK_Therapist_Prescription
    FOREIGN KEY(TherapistID)
    REFERENCES User(UserID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

CREATE TABLE Prescription_Diagnosis(
    PrescriptionID INT(8) UNSIGNED,
	DiagnosisID INT(8) UNSIGNED,
    PRIMARY KEY(PrescriptionID,DiagnosisID)
);

ALTER TABLE Prescription_Diagnosis 
    ADD CONSTRAINT FK_Prescription_Diagnosis
    FOREIGN KEY(PrescriptionID)
    REFERENCES Prescription(PrescriptionID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
 
ALTER TABLE Prescription_Diagnosis 
    ADD CONSTRAINT FK_Diagnosis_Prescription
    FOREIGN KEY(DiagnosisID)
    REFERENCES Diagnosis(DiagnosisID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
	
-- Trigger checks to make sure TherapistID and PatientID  references a Therapist and Patient respectively --
CREATE TRIGGER TR_Prescription_Insert
ON Prescription
INSTEAD OF INSERT
AS
  BEGIN
      INSERT INTO Prescription
      SELECT * 
      FROM   inserted
      WHERE  EXISTS (
		SELECT TherapistID, PatientID
		FROM   inserted
		INNER  JOIN User Therapist ON inserted.TherapistID=User.UserID
		INNER  JOIN User Patient ON inserted.PatientID=User.UserID
		INNER  JOIN UserType TherapistUserType ON Therapist.UserTypeID=UserType.UserTypeID
		INNER  JOIN UserType PatientUserType ON Patient.UserTypeID=UserType.UserTypeID
		WHERE  Therapist.Role = 'Therapist' AND Patient.Role = 'Patient'
	  )
  END 	
	
CREATE TABLE Center(
    CenterID INT(8) UNSIGNED AUTO_INCREMENT,
    Name VARCHAR(30),
	PhoneNumber VARCHAR(10),
	Address VARCHAR(100),
    PRIMARY KEY(CenterID)
);

/*review date, date type attribute?*/
CREATE TABLE Appointment(
    AppointmentID INT(8) UNSIGNED AUTO_INCREMENT,
	TrainerID INT(8) UNSIGNED,
	PrescriptionID INT(8) UNSIGNED,
	CenterID INT(8) UNSIGNED,
	Cost DOUBLE(10,2),
	Appointment_Date Date,
    PRIMARY KEY(AppointmentID)
);

ALTER TABLE Appointment
    ADD CONSTRAINT FK_Trainer_Appointment
    FOREIGN KEY(TrainerID)
    REFERENCES User(UserID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE Appointment 
    ADD CONSTRAINT FK_Prescription_Appointment
    FOREIGN KEY(PrescriptionID)
    REFERENCES Prescription(PrescriptionID);
	
ALTER TABLE Appointment 
    ADD CONSTRAINT FK_Center_Appointment
    FOREIGN KEY(CenterID)
    REFERENCES Center(CenterID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Trigger checks to make sure TrainerID references a Trainer --
CREATE TRIGGER TR_Appointment_Insert
ON Appointment
INSTEAD OF INSERT
AS
  BEGIN
      INSERT INTO Appointment
      SELECT * 
      FROM   inserted
      WHERE  EXISTS (
		SELECT TrainerID
		FROM   inserted
		INNER  JOIN User    ON inserted.TrainerID=User.UserID
		INNER  JOIN UserType ON User.UserTypeID=UserType.UserTypeID
		WHERE  Role = 'Trainer'
	  )
  END 	
	
	
CREATE TABLE DailyPayment(
    DailyPaymentID INT(8) UNSIGNED AUTO_INCREMENT,
	PaymentTypeID INT(8) UNSIGNED,
	AppointmentID INT(8) UNSIGNED,
	Amount DOUBLE(10,2),
	AccountNumber VARCHAR(16),
    PRIMARY KEY(DailyPaymentID)
);

CREATE TABLE Payment(
    PaymentID INT(8) UNSIGNED AUTO_INCREMENT,
	PaymentTypeID INT(8) UNSIGNED,
	AppointmentID INT(8) UNSIGNED,
	Amount DOUBLE(10,2),
	AccountNumber VARCHAR(16),
    PRIMARY KEY(PaymentID)
);

CREATE TABLE PaymentType(
    PaymentTypeID INT(8) UNSIGNED AUTO_INCREMENT,
	Type ENUM('Cash','Cheque','Debit','Credit'),
    PRIMARY KEY(PaymentTypeID)
);

ALTER TABLE Payment
    ADD CONSTRAINT FK_PaymentType_Payment
    FOREIGN KEY(PaymentTypeID)
    REFERENCES PaymentType(PaymentTypeID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
 
ALTER TABLE Payment 
    ADD CONSTRAINT FK_Appointment_Payment
    FOREIGN KEY(AppointmentID)
    REFERENCES Appointment(AppointmentID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE DailyPayment
    ADD CONSTRAINT FK_PaymentType_DailyPayment
    FOREIGN KEY(PaymentTypeID)
    REFERENCES PaymentType(PaymentTypeID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
 

ALTER TABLE DailyPayment
    ADD CONSTRAINT FK_Appointment_DailyPayment
    FOREIGN KEY(AppointmentID)
    REFERENCES Appointment(AppointmentID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;