# RSA_Encrypt

Encrypt and decrypt long strings using RSA (Asymmetric encryption), and work between PHP and Python.

可以加密和解密 “长字符串” 的 RSA 类，并且能在 PHP 和 Python 之间使用。


# PHP Example:

```
// Generate keys 生成公钥私钥 
list($publicKey,$privateKey) = RSA_Encrypt::generate_key_pair();

// Encrypt 加密
$str = 'Hello world! 你好世界！';
$publicKey = "------ YOUR PUBLICK KEY ------";
$rsa = new RSA_Encrypt($publicKey);
echo $rsa->encrypt($str);

// Decrypt 解密
$encryptString = 'h2nw9c0kXdvXVrjHU3y3KH43vkaO.....w0Snv1+8qi4IBN4lFE0L7F3Gl+MDCDxxQPHknA==';
$privateKey = "------ YOUR PRIVATE KEY ------";
$rsa = new RSA_Encrypt('', $privateKey);
echo $rsa->decrypt($encryptString);
```

# Python Example:

```
# Generate keys 生成公钥私钥
publicKey, privateKey = RSA_Encrypt.generate_key_pair()

# Encrypt 加密
publicKey = """------ YOUR PUBLICK KEY ------"""
rsa = RSA_Encrypt(publicKey)
string = 'Hello world! 你好世界！'
enc = rsa.encrypt(string)
print(enc)

# Decrypt 解密
privateKey = """------ YOUR PRIVATE KEY ------"""
rsa = RSA_Encrypt(privateKey)
encryptString = 'h2nw9c0kXdvXVrjHU3y3KH43vkaO.....w0Snv1+8qi4IBN4lFE0L7F3Gl+MDCDxxQPHknA=='
dec = rsa.decrypt(encryptString)
print(dec)

```
