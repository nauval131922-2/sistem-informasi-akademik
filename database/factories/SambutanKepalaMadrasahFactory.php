<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SambutanKepalaMadrasah>
 */
class SambutanKepalaMadrasahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => 1,
            'judul' => 'Sambutan Kepala Madrasah',
            'gambar' => null,
            'excerpt' => 'Alhamdulillah, segala puji dan syukur kita panjatkan ke hadirat Allah SWT yang telah melimpahkan nikmat kepada kita semua mulai dari nikmat sehat, iman, dan kesempatan untuk dapat mengabdi di bidang pendidikan untuk mencerdaskan anak bangsa.Pendidikan adalah modal utama bagi suatu bangsa dalam upaya meningkatkan kualitas sumber daya manusia yang dimilikinya. Sumber daya manusia yang berkualitas akan mampu mengelola sumber daya alam untuk meningkatkan kesejahteraan masyarakat.MI NU Nurul Ulum seb...',
            'isi' => '<div>Alhamdulillah, segala puji dan syukur kita panjatkan ke hadirat Allah SWT yang telah melimpahkan nikmat kepada kita semua mulai dari nikmat sehat, iman, dan kesempatan untuk dapat mengabdi di bidang pendidikan untuk mencerdaskan anak bangsa.<br><br>Pendidikan adalah modal utama bagi suatu bangsa dalam upaya meningkatkan kualitas sumber daya manusia yang dimilikinya. Sumber daya manusia yang berkualitas akan mampu mengelola sumber daya alam untuk meningkatkan kesejahteraan masyarakat.<br><br></div><div>MI NU Nurul Ulum sebagai salah satu Madrasah yang senantiasa berusaha mewujudkan apa yang menjadi harapan pemerintah dan masyarakat melalui serangkaian kegiatan dan program kerja yang berorientasi pada peningkatan&nbsp; mutu pendidikan, kualitas, dan pembentukan karakter peserta didik yang sesuai dengan ahlussunnah wal jamaah. Dalam rangka merealisasikan hal tersebut perlu dijalin kerjasama dan komunikasi yang baik antara pihak sekolah, masyarakat dan pemerintah.</div>',
            // created_at dan updated_at diisi dengan tanggal hari ini
            'created_at' => now(),
        ];
    }
}
