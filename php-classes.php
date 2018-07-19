<?php
// create a Student class that has private states and public interface
class Student {
	private $studentFullName = '';
	private $studentAge = 0;

	// class constructor
	public function __construct(string $name, int $age) {
		try {
			$this->setStudentName($name);
			$this->setStudentAge($age);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw (new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	//class accessors
	public function getStudentFullName(): string {
		return ($this->studentFullName);
	}

	public function getStudentAge(): int {
		return ($this->studentAge);
	}

	// class mutators
	public function setStudentName(string $name): void {
		$name = filter_var(trim($name), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($name) === true ) {
			throw new InvalidArgumentException("content is empty or insecure");
		}
		$this->studentFullName = $name;
	}

	public function setStudentAge(int $age): void {
		if ($age <=0) {
			throw new InvalidArgumentException("invalid age");
		}
		$this->studentAge = $age;
	}
}

// instantiate a couple of objects
$student1 = new Student( "Joe Smith", 18);
$student2 = new Student("Jen Cook", 19);

// print out the properties of the objects
echo $student1->getStudentFullName() ." is " .$student1->getStudentAge() ." years old. <br />";
echo $student2->getStudentFullName() ." is " .$student2->getStudentAge() ." years old. <br />";

?>