
# PHP Example:

```
// 生成公钥私钥
list($publicKey,$privateKey) = RSA_Encrypt::generate_key_pair();

// 加密
$str = 'Hello world! 你好世界！';
$publicKey = "------ YOUR PUBLICK KEY ------";
$rsa = new RSA_Encrypt($publicKey);
echo $rsa->encrypt($str);

// 解密
$encryptString = 'h2nw9c0kXdvXVrjHU3y3KH43vkaO.....w0Snv1+8qi4IBN4lFE0L7F3Gl+MDCDxxQPHknA==';
$privateKey = "------ YOUR PRIVATE KEY ------";
$rsa = new RSA_Encrypt('', $privateKey);
echo $rsa->decrypt($encryptString);
```

# Python Example:

```
# 生成公钥私钥
publicKey, privateKey = RSA_Encrypt.generate_key_pair()

# 加密
publicKey = """------ YOUR PUBLICK KEY ------"""
rsa = RSA_Encrypt(publicKey)
string = 'Hello world! 你好世界！'
enc = rsa.encrypt(string)
print(enc)

# 解密
privateKey = """------ YOUR PRIVATE KEY ------"""
rsa = RSA_Encrypt(privateKey)
encryptString = 'h2nw9c0kXdvXVrjHU3y3KH43vkaO.....w0Snv1+8qi4IBN4lFE0L7F3Gl+MDCDxxQPHknA=='
dec = rsa.decrypt(encryptString)
print(dec)

```
