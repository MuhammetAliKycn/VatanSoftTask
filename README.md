
composer i 
cp .env.example .env 
php artisan jwt:secret
php artisan migrate
php artisan storage:link
php artisan serve
php artisan test
...

*Swagger UI kurulumu ve annotation maddesini daha önce hiç kullanmadım ve şuanda kullanıp çalıştırsam dahi daha sonradan bug çıkarma ihtmaline karşı bu maddeyi geçtim Postman ile çalıştım.

*Api testleri için postman kullandım daha önceden çok fazla unit test yazmadım ama basic olarak ekledim yinede. Api collection'ı proje içerisinde /postmant_collection/ klasörü içerisinde mevcuttur. 

*MVC tasarım desenini kullanmaya alışkınım ve son birkaç projemde repository desenine geçiş yaptım. Şu anda, geliştirmelerimi repository deseniyle sürdürmeye çalışıyorum. Bu geçiş sayesinde, kodlarımı daha düzenli ve bakımı kolay hale getirebileceğime inanıyorum. MVC mimarisine olan aşinalığım, bu yeni deseni daha etkili bir şekilde uygulamama yardımcı oluyor.
