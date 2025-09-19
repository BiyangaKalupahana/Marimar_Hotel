<?php

/**
 * Description:      This is a class for member.
 * Author:           Joken Villanueva
 * Date Created: Nov. 2, 2013
 * Revised By:
 */
require_once(LIB_PATH . DS . 'database.php');
class Accomodation
{

	protected static $tbl_name = "tblaccomodation";
	public $ACCOMID;
	public $ACCOMODATION;
	public $ACCOMDESC;

	function db_fields()
	{
		global $mydb;
		return $mydb->getFieldsOnOneTable(self::$tbl_name);
	}
	function listOfaccomodation()
	{
		global $mydb;
		$mydb->setQuery("Select * from " . self::$tbl_name);
		$cur = $mydb->loadResultList();
		return $cur;
	}

	function listOfaccomodationNotIn($id = 0)
	{
		global $mydb;
		// Corrected: Using prepared statement to prevent SQL injection
		$stmt = $mydb->prepare("SELECT * FROM `tblaccomodation` WHERE `ACCOMID` <> ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$cur = $stmt->get_result();
		return $cur->fetch_all(MYSQLI_ASSOC);
	}

	function single_accomodation($id = 0)
	{
		global $mydb;
		// Corrected: Using prepared statement to prevent SQL injection
		$stmt = $mydb->prepare("SELECT * FROM " . self::$tbl_name . " WHERE `ACCOMID` = ? LIMIT 1");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$cur = $stmt->get_result();
		return $cur->fetch_assoc();
	}

	function find_all_accomodation($name = "")
	{
		global $mydb;
		// Corrected: Using prepared statement to prevent SQL injection
		$stmt = $mydb->prepare("SELECT * FROM " . self::$tbl_name . " WHERE `ACCOMODATION` = ?");
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$cur = $stmt->get_result();
		return $cur->num_rows;
	}

	/*---Instantiation of Object dynamically---*/
	static function instantiate($record)
	{
		$object = new self;

		foreach ($record as $attribute => $value) {
			if ($object->has_attribute($attribute)) {
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	/*--Cleaning the raw data before submitting to Database--*/
	private function has_attribute($attribute)
	{
		return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes()
	{
		global $mydb;
		$attributes = array();
		foreach ($this->db_fields() as $field) {
			if (property_exists($this, $field)) {
				$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}

	protected function sanitized_attributes()
	{
		global $mydb;
		$clean_attributes = array();
		foreach ($this->attributes() as $key => $value) {
			$clean_attributes[$key] = $mydb->escape_value($value);
		}
		return $clean_attributes;
	}

	/*--Create,Update and Delete methods--*/
	public function save()
	{
		return isset($this->ACCOMID) ? $this->update() : $this->create();
	}

	public function create()
	{
		global $mydb;
		$attributes = $this->sanitized_attributes();
		$fields = array_keys($attributes);
		$values = array_values($attributes);
		$placeholders = implode(',', array_fill(0, count($fields), '?'));

		$sql = "INSERT INTO " . self::$tbl_name . " (" . implode(", ", $fields) . ") VALUES (" . $placeholders . ")";

		$stmt = $mydb->prepare($sql);
		// Assuming all values are strings for simplicity. You might need to adjust 's' for different data types.
		$types = str_repeat('s', count($fields));
		$stmt->bind_param($types, ...$values);

		if ($stmt->execute()) {
			$this->ACCOMID = $mydb->insert_id();
			return true;
		} else {
			return false;
		}
	}

	public function update()
	{
		global $mydb;
		$attributes = $this->sanitized_attributes();
		$fields = array_keys($attributes);
		$values = array_values($attributes);

		$attribute_pairs = array();
		foreach ($fields as $field) {
			$attribute_pairs[] = "{$field}=?";
		}

		$sql = "UPDATE " . self::$tbl_name . " SET " . implode(", ", $attribute_pairs) . " WHERE ACCOMID = ?";

		$stmt = $mydb->prepare($sql);
		$types = str_repeat('s', count($values)) . 'i'; // s for strings, i for integer ID
		$values[] = $this->ACCOMID; // Add the ID to the values array for binding

		$stmt->bind_param($types, ...$values);

		return $stmt->execute();
	}

	public function delete($id = 0)
	{
		global $mydb;
		// Corrected: Using prepared statement to prevent SQL injection
		$stmt = $mydb->prepare("DELETE FROM " . self::$tbl_name . " WHERE ACCOMID = ? LIMIT 1");
		$stmt->bind_param("i", $id);
		// Corrected: Return a boolean value
		return $stmt->execute();
	}
}
