
1. Followed along with the Api Platform getting started tutorial (https://api-platform.com/docs/distribution/)
2. Added filters (https://api-platform.com/docs/core/filters/)



### Generating SSH keys for JWT Auth

`$ mkdir -p config/jwt`

`$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`

`$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`

[LexiJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md)

Todo
1. Serialization groups
2. Author entity
3. JWT tokens, authentication and authorization
