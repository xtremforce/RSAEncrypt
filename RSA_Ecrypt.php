/** 
 * RSA encrypt and decrypt long string
 * /
class RSA_Encrypt
{
    private $publicKey;
    private $privateKey;

    public function __construct($publicKey = "", $privateKey = "")
    {
        if (!empty($publicKey)) {
            $this->publicKey = openssl_pkey_get_public($publicKey);
        }
        if (!empty($privateKey)) {
            $this->privateKey = openssl_pkey_get_private($privateKey);
        }
    }

    /**
     * Generates a key pair consisting of a public key and a private key.
     *
     * @return array An array containing the public key and private key.
     */
    public static function generate_key_pair()
    {
        // Configuration options for key generation
        $config = array(
            "digest_alg"       => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        // Generate a new key pair
        $res = openssl_pkey_new($config);

        // Export the private key
        openssl_pkey_export($res, $privateKey);

        // Get the public key details and extract the key
        $publicKey = openssl_pkey_get_details($res)['key'];

        // Return the public key and private key as an array
        return array($publicKey, $privateKey);
    }

    /**
     * Splits a long string into an array of smaller strings of a specified length.
     *
     * @param string $string The input string to be split.
     * @param int $length The length of each substring.
     * @return array The array of substrings.
     */
    public function mb_str_split($string, $length)
    {
        $result       = [];
        $stringLength = mb_strlen($string, 'UTF-8');

        // Loop through the input string, incrementing by the specified length
        for ($i = 0; $i < $stringLength; $i += $length) {
            // Get a substring of the specified length from the input string
            $substring = mb_substr($string, $i, $length, 'UTF-8');
            
            // Add the substring to the result array
            $result[] = $substring;
        }

        return $result;
    }

    /**
     * Encrypts a given string using RSA encryption.
     *
     * @param string $str The string to be encrypted.
     * @return string The encrypted string.
     */
    public function encrypt($str)
    {
        if (empty($this->publicKey)) {
            throw new Exception("publicKey is empty");
        }

        // RSA encryption counld not handle long strings, so we split the string into chunks
        // Split the long string into chunks of maximum 90 characters
        $strArr = $this->mb_str_split($str, 90);

        $encryptedChunks = [];
        for ($i = 0; $i < count($strArr); $i++) {
            $encryptedChunk = "";
            openssl_public_encrypt($strArr[$i], $encryptedChunk, $this->publicKey);
            $encryptedChunks[] = base64_encode($encryptedChunk);
        }
        
        // Join the encrypted chunks using the "|" separator
        return join("|", $encryptedChunks);
    }

    /**
     * Decrypts an encrypted string.
     *
     * @param string $encryptedStr The encrypted string.
     * @return string The decrypted string.
     */
    public function decrypt($encryptedStr)
    {
        if (empty($this->privateKey)) {
            throw new Exception("privateKey is empty");
        }

        // Split the encrypted string into an array of substrings
        $encryptedArray = explode("|", $encryptedStr);

        // Initialize an array to store the decrypted substrings
        $decryptedArray = [];

        // Decrypt each substring and add it to the decrypted array
        foreach ($encryptedArray as $encryptedSubstring) {
            $decrypted = "";
            openssl_private_decrypt(base64_decode($encryptedSubstring), $decrypted, $this->privateKey);
            $decryptedArray[] = $decrypted;
        }

        // Join the decrypted substrings into a single string
        return implode("", $decryptedArray);
    }
}
