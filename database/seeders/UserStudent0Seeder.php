<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserStudent0Seeder extends Seeder
{
    private $seeds;

    public function __construct()
    {
        $this->seeds = $this->buildSeeds();

    }

    private function buildSeeds()
    {
        return [
            [435,'hchoi','$2y$10$0zjAD/eR7QGbWGvCyILIU.Q.BszeVGAMgpf5C3XdE1Pcy.n4bEEK.','2021-04-01','2021-04-01'],
            [436,'jsiochi','$2y$10$w5XW10m2w2QXW4vaQlfJm.kbK6.2s5Dix4TPRLj/Bc3bofp63kt92','2021-04-01','2021-04-01'],
            [437,'aberenshtein','$2y$10$MwKpNnPKrLDbc9wWB6LMwukJIKaZt4Ty4B7Of6dKDPvY59MSq2NsC','2021-04-01','2021-04-01'],
            [438,'fsong','$2y$10$/.SyUZHrxKM/lOv4Z5OXT.aAKs0IVc2nAYRH.rOdni./KyvJuqGfy','2021-04-01','2021-04-01'],
            [439,'rchatterjee','$2y$10$DwG6k8ZeIx2/tvr1RuHA6eMDnW3XkyxP8JfT2ejbFXKTmoQ9J3PIa','2021-04-01','2021-04-01'],
            [440,'bmordi','$2y$10$tN.NRL3Tyyvkn9JpAO.SxeRDozI0YlCYmy53v8o0kZ0GC1KIrFFty','2021-04-01','2021-04-01'],
            [441,'jmordi','$2y$10$PXZvLexkcK63I1kiulzx.OktvAQklhqX77wWfrbuS//F28WrjaVO2','2021-04-01','2021-04-01'],
            [442,'bruiz','$2y$10$cBTdPgYjXZp62mAdxY3tQOPDUPIpKH1MfDwYn.OhIdampMksy5/kS','2021-04-01','2021-04-01'],
            [443,'akarwowski','$2y$10$s96REl5fBYRv0Xpxjj0znOPPKBQGhtbKjm9cNCtrEYLcCRebho7Wq','2021-04-01','2021-04-01'],
            [444,'egut','$2y$10$mHD9HNCqall5WcTb/13.8.19TvWn3udLHNbQz0shii/f5UNBoW26i','2021-04-01','2021-04-01'],
            [445,'hbrownstein','$2y$10$5lCKa6Ps9rRXGKIm9R/AOu02sYY1tavR6P/K9zKlKRbNEEoMB36UG','2021-04-01','2021-04-01'],
            [446,'mangulo','$2y$10$1323O9S5pkEzxdZA.tqQU.EDb1b9flXKcdC7sabbhQ6Es9g.zOMOW','2021-04-01','2021-04-01'],
            [447,'jlaws','$2y$10$c2Vx4VDBb/ZfQTfSU57GwOOkDUWzV6NJ0ADp/wTtNG.xc7rbQhZ2i','2021-04-01','2021-04-01'],
            [448,'nprice','$2y$10$GdCykilVsC4FaBQirEKtr.FqMjZUoS/pnMXVD9MNLVG3YNL4hBBFC','2021-04-01','2021-04-01'],
            [449,'sroser','$2y$10$K33UTWoekj/y1ve2nnPdYOGfy08eb7t1PKjvPLOkAazcWhAZxFCY6','2021-04-01','2021-04-01'],
            [450,'afalzon','$2y$10$o7daGbX0pLVHPGN7WkLOb.ct79jnO2Vduk4kHwSKj0QbLL35puN82','2021-04-01','2021-04-01'],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds AS $seed){

            User::create([
                'id' => $seed[0],
                'username' => $seed[1],
                'password' => Hash::make('Password1!'),
            ]);
        }
    }
}
