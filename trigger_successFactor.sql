CREATE TRIGGER `Calculate_SuccessFactor` 
AFTER INSERT ON `study_home`
FOR EACH ROW
BEGIN
    IF (NEW.home_semester > 1) THEN
    UPDATE student_new SET successFactor = 0.125 * NEW.home_credits / (NEW.home_cgpa * (NEW.home_semester - 1)) WHERE personalid = NEW.studentid;
    ELSE
    UPDATE student_new SET successFactor = 0 WHERE personalid = NEW.studentid;
END IF;
END