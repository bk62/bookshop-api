
# Bookshop API

Exploring API Platform features and development.

### WIP

1. Followed along with the Api Platform getting started tutorial (https://api-platform.com/docs/distribution/)
2. Added filters (https://api-platform.com/docs/core/filters/)
3. Entities generated from related schema.org schemas
4. Added JWT authentication and basic authorization


### Generating SSH keys for JWT Auth

`$ mkdir -p config/jwt`

`$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`

`$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`

[LexiJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md)

Todo
- Serialization groups
- Authorization rules - use ROLES, check ownership etc
- Generate admin and client apps - and serve
- Add and use Doctrine migrations
- Registration
- API resources config for organization, person etc 