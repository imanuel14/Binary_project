<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Sistem Informasi Yayasan Mutiara Kasih Karunia (YMKK)

Project ini merupakan sistem pengelolaan informasi terpadu untuk Yayasan Mutiara Kasih Karunia, yang mencakup manajemen data jemaat, profil organisasi, hingga portal informasi publik.

---

## 👥 Struktur Tim & Pembagian Kerja (Agile/Scrum)

Kami menggunakan metodologi **Agile** dengan pembagian divisi yang spesifik untuk memastikan kolaborasi berjalan maksimal melalui GitHub Branching.

###  Divisi 1: Core System
| Nama | Peran | Deskripsi Tugas |

| **Anggota 1 Arisman B Zai** | **Database Architect** | Merancang skema database (Migrations) & Eloquent Models. |
| **Anggota 2 Yulius Nono & Imanuel Raubun** | **Security & Auth** | Implementasi sistem Login, Logout, dan Middleware (Role Check). |

### 🛠️ Divisi 2: Admin Panel (Backend)
| Nama | Peran | Deskripsi Tugas |

| **Anggota 3 Grace A Joy** | **User Manager** | Pengembangan CRUD untuk pengelolaan akun Staff/Pengguna. |
| **Anggota 4 Grace A Joy** | **Data Jemaat Specialist** | Pendataan jemaat dan fitur ekspor data ke Excel/PDF. |
| **Anggota 5 Hikayat Telaumbanua** | **Organization Info** | Manajemen konten profil yayasan dan struktur organisasi. |

###  Divisi 3: Staff Panel (Operational)
| Nama | Peran | Deskripsi Tugas |

| **Anggota 6 Charles** | **Dashboard Admin** | Integrasi statistik data dan grafik pada dashboard utama. |
| **Anggota 7 Samuel Berutu** | **Staff Field Operator** | Manajemen update program kerja dan pengelolaan kontak masuk. |

### Divisi 4: Public Website (Frontend)
| Nama | Peran | Deskripsi Tugas |

| **Anggota  Gerarda S P Sarangah8** | **Home & Profile UI** | Slicing UI Landing Page dan halaman profil yayasan. |
| **Anggota 9 Elsa Gespri S** | **Media & Gallery** | Pengembangan fitur galeri foto kegiatan dan dokumentasi. |
| **Anggota 10 Markus** | **Public Service Info** | Informasi layanan publik, jadwal kegiatan, dan pengumuman. |

---

## Teknologi & Tools
* **Framework:** Laravel 12
* **Language:** PHP, JavaScript, Blade
* **Database:** MySQL
* **Version Control:** Git & GitHub
