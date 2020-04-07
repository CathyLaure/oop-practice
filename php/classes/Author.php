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
	private $authorAvartarUrl;

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
	 * @param string $authorActivationToken activation token to safe gaurd against malicious entry
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
	public function __construct($authorId,string $authorActivationToken,?string $authorAvartarUrl,string $authorEmail,string $authorHash,string $authorUsername) {
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

	public function jsonserialize() {

	}

}