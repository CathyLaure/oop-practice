<?php
namespace CathyLaure\OopPractice;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/*
 * This is the Author class
 */
class Author implements \JsonSerializable {
	use ValidateUuid;

//authorId binary(16) not null,
//authorActivationToken char(32),
//authorAvatarUrl varchar(255),
//authorEmail varchar(128) not null,
//authorHash char(97) not null,
//authorUsername varchar(32) not null,

	/*
	 * id for this primary key
 	* @var Uuid authorId
 	*/
	private $authorId;

	/*
	 * activation token for this author
	 */
	private $authorActivationToken;

	/*
	 * avatar url for this Author
	 */
	private $authorAvatarUrl;

	/*
	 * email for this Author
	 * @var string $authorEmail
	 */
	private $authorEmail;

	/*
	 * hash for this Author
	 * @var string $authorHash
	 */
	private $authorHash;

	/*
	 * username for this Author
	 * @var string $authorUsername
	 */
	private $authorUsername;


	/*
	 * Constructor for this Author
	 * @param string|Uuid $authorId id of Author or null if a new id
	 * @param string $authorActivationToken activation token to safe gaurd against malicious code
	 * @param string $authorAvatarUrl string containing an avatar url or null
	 * @param string $authorEmail string containing the email
	 * @param string $authorHash string containing the password hash
	 * @param string $authorUsername string containing username
	 * @throws \InvalidArgumentException if data typs are not valid
	 * @throws \RangeException if data values are out of bound (eg , strings too long)
	 * @throws \TypeError if data types voilates data hints
	 * @throws \ Exception if some other exception uccurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct($newAuthorId,string $newAuthorActivationToken,?string $newAuthorAvatarUrl,string $newAuthorEmail,string $newAuthorHash,string $newAuthorUsername) {
		try{
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for author id
	 *
	 * @return Uuid value of author id
	 **/
	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * mutator method for author id
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/
	public function setAuthorId( $newAuthorId) : void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		$this->authorId = $uuid;
	}


	/**
	 * accessor method for activation Token
	 *
	 * @return string value of activation token
	 **/

	public function getAuthorActivationToken() : ?string {
		return($this->authorActivationToken);
	}

	/**
	 * mutator method for author activationToken
	 *
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or is insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 **/
	public function setAuthorActivationToken(string $newAuthorActivationToken): void {
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("author activation is not valid"));
		}
		//make sure the author activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("author activation has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/*
	 * accessor foe author Avater Url
	 */
	public function getAuthorAvatarUrl() : string {
		return($this->newAuthorAvatarUrl());
	}

	public function jsonserialize() {
		//TODO: Implement jsonserializ
	}

}