# everyday.dev

> **everyday.dev** is a platform where developers and tech enthusiasts engage with knowledge through collaboration, discussion and learning, fostering the collective growth of the developer community. It will empower developers to stay updated with industry trends, enhance their skills, and streamline their learning.

## How to run the project

To run the project, use ```./start.sh```to intialize everything for you.
Alternatively, you can start the database and the mail server using ```docker-compose up -d```.

## Project credentials

### Administration Credentials

> Administration URL: http://localhost:8001/admin

| Username          | Password |
| ----------------- | -------- |
| admin@example.com | admin    |

> **Note** the administrative password to demote other admins: `secure-by-design`

### User Credentials

| Type          | Username           | Password |
| ------------- | ------------------ | -------- |
| basic account | rubem@example.com  | 123123   |
| basic account | mansur@example.com | 1234     |
| news author   | afonso@example.com | 1234     |
| basic account | diogo@example.com  | 1234     |

###Mailtrap Credentials

| Login              | Password |
| ------------------ | -------- |
| lbaw2441@gmail.com | lbaw2441 |


## Project Components

* [ER: Requirements Specification](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24041/-/wikis/er)
* [EBD: Database Specification](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24041/-/wikis/edb)
* [EAP: Architecture Specification and Prototype](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24041/-/wikis/eap)
* [PA: Product and Presentation](https://gitlab.up.pt/lbaw/lbaw2425/lbaw24041/-/wikis/pa)

## Artefacts Checklist
+ The artefacts checklist is available at this [link](https://docs.google.com/spreadsheets/d/1Slm9z7z6odYqT0jRxVVs8Aj4tcNGQtVQG1Yro9hezzI/edit?gid=1240712519#gid=1240712519).

## Team

* Afonso Moura, up202207931@fe.up.pt
* Diogo Goiana, up202207944@fe.up.pt
* Mansur Mustafin, up202102355@fe.up.pt
* Rubem Neto, up202207086@fe.up.pt

## 

GROUP24041, 26/09/2024

<!-- 

sudo apt update
sudo apt install git composer php8.3 php8.3-mbstring php8.3-xml php8.3-pgsql php8.3-curl

composer update

docker compose up -d

php artisan db:seed
php artisan serve

./upload_image.sh

docker login gitlab.up.pt:5050
docker run -d --name lbaw24041 -p 8001:80 gitlab.up.pt:5050/lbaw/lbaw2425/lbaw24041

 -->