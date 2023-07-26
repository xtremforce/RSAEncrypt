from Crypto.PublicKey import RSA
from Crypto.Cipher import PKCS1_v1_5
import base64


class RSA_Encrypt:
    """
    RSA encrypt and decrypt long string
    https://github.com/xtremforce/RSAEncrypt
    """
    def __init__(self, publicKey=None, privateKey=None):
        if(publicKey is not None):
            self.publicKey = RSA.import_key(publicKey)
        if(privateKey is not None):
            self.privateKey = RSA.import_key(privateKey)
          
    @staticmethod
    def generate_key_pair():
        key = RSA.generate(2048)
        publicKey = key.publickey().export_key().decode()
        privateKey = key.export_key().decode()
        return publicKey, privateKey

    def split_string(self,string, length):
        return [string[i:i+length] for i in range(0, len(string), length)]

    def encrypt(self, data):
        if self.publicKey is None:
            raise Exception("publicKey is None")
        
        cipher = PKCS1_v1_5.new(self.publicKey)
        strArray = self.split_string(data, 90)
        encryptedArray = []
        for string in strArray:
            encrypted = cipher.encrypt(string.encode())
            encryptedArray.append(base64.b64encode(encrypted).decode())
        return "|".join(encryptedArray)

    def decrypt(self, encryptedData):
        if self.privateKey is None:
            raise Exception("privateKey is None")

        cipher = PKCS1_v1_5.new(self.privateKey)
        encryptedArray = encryptedData.split("|")
        decryptedArray = []
        for string in encryptedArray:
            encrypted = base64.b64decode(string.encode())
            decrypted = cipher.decrypt(encrypted, None)
            decryptedArray.append(decrypted.decode())

        return "".join(decryptedArray)
