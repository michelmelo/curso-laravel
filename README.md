# Curso Laravel

## estrutura das pastas
´´´sh
.
├── README.md
├── Untitled-1.yml
├── app
│   ├── Console
│   │   ├── Commands
│   │   │   └── Demo.php
│   │   └── Kernel.php
│   ├── Exceptions
│   │   └── Handler.php
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── Auth
│   │   │   │   ├── ConfirmPasswordController.php
│   │   │   │   ├── ForgotPasswordController.php
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── RegisterController.php
│   │   │   │   ├── ResetPasswordController.php
│   │   │   │   └── VerificationController.php
│   │   │   ├── Controller.php
│   │   │   ├── EmpresasController.php
│   │   │   ├── HomeController.php
│   │   │   └── UserController.php
│   │   ├── Kernel.php
│   │   └── Middleware
│   │       ├── Authenticate.php
│   │       ├── EncryptCookies.php
│   │       ├── PreventRequestsDuringMaintenance.php
│   │       ├── RedirectIfAuthenticated.php
│   │       ├── TrimStrings.php
│   │       ├── TrustHosts.php
│   │       ├── TrustProxies.php
│   │       ├── ValidateSignature.php
│   │       └── VerifyCsrfToken.php
│   ├── Models
│   │   ├── Empresa.php
│   │   └── User.php
│   ├── Policies
│   │   └── EmpresaPolicy.php
│   └── Providers
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── artisan
├── backup-whateverfolder-2024-11-20.txt
├── bootstrap
│   ├── app.php
│   └── cache
│       ├── packages.php
│       └── services.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   └── view.php
├── database
│   ├── factories
│   │   ├── StatusFactory.php
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│   │   ├── 2014_10_12_100000_create_password_resets_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   └── 2024_11_14_142003_create_empresas_table.php
│   └── seeders
│       ├── DatabaseSeeder.php
│       └── Status.php
├── package-lock.json
├── package.json
├── phpunit.xml
├── public
│   ├── build
│   │   ├── assets
│   │   │   ├── app-CrG75o6_.js
│   │   │   └── app-DqME6eCz.css
│   │   └── manifest.json
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   ├── sass
│   │   ├── _variables.scss
│   │   └── app.scss
│   └── views
│       ├── auth
│       │   ├── login.blade.php
│       │   ├── passwords
│       │   │   ├── confirm.blade.php
│       │   │   ├── email.blade.php
│       │   │   └── reset.blade.php
│       │   ├── register.blade.php
│       │   └── verify.blade.php
│       ├── empresas
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       ├── errors
│       │   └── 403.blade.php
│       ├── home.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       ├── users
│       │   ├── add.blade.php
│       │   ├── edit.blade.php
│       │   └── index.blade.php
│       └── welcome.blade.php
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   │   └── public
│   ├── framework
│   │   ├── cache
│   │   │   └── data
│   │   ├── sessions
│   │   │   ├── AHDj7R4Z2OggqUnPAyaHpg4NrbE19v0zxnEtxBjL
│   │   │   └── Ek2DcRLMYkXduyT5QwQjoNp4bKTa618htcgPcO4s
│   │   ├── testing
│   │   └── views
│   │       ├── 3f8c696f52ba389fe47e8024d645a0b2.php
│   │       ├── 4f64ab5d669d7ce6c81569068333b124.php
│   │       ├── 51dc13dd4848c338b80b8e2ee6b8ab62.php
│   │       ├── 666dd90bbb1cc8168b94e4e37a9a2c8d.php
│   │       ├── 4316df6acddbb868fefdc04b65e35bf1.php
│   │       ├── 4648c663ace0e53246f8bff4adc0668b.php
│   │       ├── a509100d8590d7d6d5b179b408e37faa.php
│   │       ├── b7b0557a01fc376d857b3d0496170679.php
│   │       ├── bd4c9506110244fcf569aa61bc0f47a0.php
│   │       └── db49f9f6d2379de92f465c8d2c37ac4d.php
│   └── logs
│       └── laravel.log
├── stubs
│   ├── cast.inbound.stub
│   ├── cast.stub
│   ├── console.stub
│   ├── controller.api.stub
│   ├── controller.invokable.stub
│   ├── controller.model.api.stub
│   ├── controller.model.stub
│   ├── controller.nested.api.stub
│   ├── controller.nested.singleton.api.stub
│   ├── controller.nested.singleton.stub
│   ├── controller.nested.stub
│   ├── controller.plain.stub
│   ├── controller.singleton.api.stub
│   ├── controller.singleton.stub
│   ├── controller.stub
│   ├── event.stub
│   ├── factory.stub
│   ├── job.queued.stub
│   ├── job.stub
│   ├── mail.stub
│   ├── markdown-mail.stub
│   ├── markdown-notification.stub
│   ├── middleware.stub
│   ├── migration.create.stub
│   ├── migration.stub
│   ├── migration.update.stub
│   ├── model.pivot.stub
│   ├── model.stub
│   ├── notification.stub
│   ├── observer.plain.stub
│   ├── observer.stub
│   ├── policy.plain.stub
│   ├── policy.stub
│   ├── provider.stub
│   ├── request.stub
│   ├── resource-collection.stub
│   ├── resource.stub
│   ├── rule.stub
│   ├── scope.stub
│   ├── seeder.stub
│   ├── test.stub
│   ├── test.unit.stub
│   └── view-component.stub
├── tests
│   ├── CreatesApplication.php
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── TestCase.php
│   └── Unit
│       └── ExampleTest.php
└── vite.config.js

48 directories, 160 files
´´´
## comando basicos

## Ideias