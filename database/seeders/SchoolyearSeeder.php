<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolyearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schoolyears')->insert([
            ['id' => 1980, 'descr' => '1979-1980','startdate' => '1979-09-01','enddate' => '1980-08-31','created_at' => now()],
            ['id' => 1981, 'descr' => '1980-1981','startdate' => '1980-09-01','enddate' => '1981-08-31','created_at' => now()],
            ['id' => 1982, 'descr' => '1981-1982','startdate' => '1981-09-01','enddate' => '1982-08-31','created_at' => now()],
            ['id' => 1983, 'descr' => '1982-1983','startdate' => '1982-09-01','enddate' => '1983-08-31','created_at' => now()],
            ['id' => 1984, 'descr' => '1983-1984','startdate' => '1983-09-01','enddate' => '1984-08-31','created_at' => now()],
            ['id' => 1985, 'descr' => '1984-1985','startdate' => '1984-09-01','enddate' => '1985-08-31','created_at' => now()],
            ['id' => 1986, 'descr' => '1985-1986','startdate' => '1985-09-01','enddate' => '1986-08-31','created_at' => now()],
            ['id' => 1987, 'descr' => '1986-1987','startdate' => '1986-09-01','enddate' => '1987-08-31','created_at' => now()],
            ['id' => 1988, 'descr' => '1987-1988','startdate' => '1987-09-01','enddate' => '1988-08-31','created_at' => now()],
            ['id' => 1989, 'descr' => '1988-1988','startdate' => '1988-09-01','enddate' => '1989-08-31','created_at' => now()],
            ['id' => 1990, 'descr' => '1989-1990','startdate' => '1989-09-01','enddate' => '1990-08-31','created_at' => now()],
            ['id' => 1991, 'descr' => '1990-1991','startdate' => '1990-09-01','enddate' => '1991-08-31','created_at' => now()],
            ['id' => 1992, 'descr' => '1991-1992','startdate' => '1991-09-01','enddate' => '1992-08-31','created_at' => now()],
            ['id' => 1993, 'descr' => '1992-1993','startdate' => '1992-09-01','enddate' => '1993-08-31','created_at' => now()],
            ['id' => 1994, 'descr' => '1993-1994','startdate' => '1993-09-01','enddate' => '1994-08-31','created_at' => now()],
            ['id' => 1995, 'descr' => '1994-1995','startdate' => '1994-09-01','enddate' => '1995-08-31','created_at' => now()],
            ['id' => 1996, 'descr' => '1995-1996','startdate' => '1995-09-01','enddate' => '1996-08-31','created_at' => now()],
            ['id' => 1997, 'descr' => '1996-1997','startdate' => '1996-09-01','enddate' => '1997-08-31','created_at' => now()],
            ['id' => 1998, 'descr' => '1997-1998','startdate' => '1997-09-01','enddate' => '1998-08-31','created_at' => now()],
            ['id' => 1999, 'descr' => '1998-1999','startdate' => '1998-09-01','enddate' => '1999-08-31','created_at' => now()],
            ['id' => 2000, 'descr' => '1999-2000','startdate' => '1999-09-01','enddate' => '2000-08-31','created_at' => now()],
            ['id' => 2001, 'descr' => '2000-2001','startdate' => '2000-09-01','enddate' => '2001-08-31','created_at' => now()],
            ['id' => 2002, 'descr' => '2001-2002','startdate' => '2001-09-01','enddate' => '2002-08-31','created_at' => now()],
            ['id' => 2003, 'descr' => '2002-2003','startdate' => '2002-09-01','enddate' => '2003-08-31','created_at' => now()],
            ['id' => 2004, 'descr' => '2003-2004','startdate' => '2003-09-01','enddate' => '2004-08-31','created_at' => now()],
            ['id' => 2005, 'descr' => '2004-2005','startdate' => '2004-09-01','enddate' => '2005-08-31','created_at' => now()],
            ['id' => 2006, 'descr' => '2005-2006','startdate' => '2005-09-01','enddate' => '2006-08-31','created_at' => now()],
            ['id' => 2007, 'descr' => '2006-2007','startdate' => '2006-09-01','enddate' => '2007-08-31','created_at' => now()],
            ['id' => 2008, 'descr' => '2007-2008','startdate' => '2007-09-01','enddate' => '2008-08-31','created_at' => now()],
            ['id' => 2009, 'descr' => '2008-2009','startdate' => '2008-09-01','enddate' => '2009-08-31','created_at' => now()],
            ['id' => 2010, 'descr' => '2009-2010','startdate' => '2009-09-01','enddate' => '2010-08-31','created_at' => now()],
            ['id' => 2011, 'descr' => '2010-2011','startdate' => '2010-09-01','enddate' => '2011-08-31','created_at' => now()],
            ['id' => 2012, 'descr' => '2011-2012','startdate' => '2011-09-01','enddate' => '2012-08-31','created_at' => now()],
            ['id' => 2013, 'descr' => '2012-2013','startdate' => '2012-09-01','enddate' => '2013-08-31','created_at' => now()],
            ['id' => 2014, 'descr' => '2013-2014','startdate' => '2013-09-01','enddate' => '2014-08-31','created_at' => now()],
            ['id' => 2015, 'descr' => '2014-2015','startdate' => '2014-09-01','enddate' => '2015-08-31','created_at' => now()],
            ['id' => 2016, 'descr' => '2015-2016','startdate' => '2015-09-01','enddate' => '2016-08-31','created_at' => now()],
            ['id' => 2017, 'descr' => '2016-2017','startdate' => '2016-09-01','enddate' => '2017-08-31','created_at' => now()],
            ['id' => 2018, 'descr' => '2017-2018','startdate' => '2017-09-01','enddate' => '2018-08-31','created_at' => now()],
            ['id' => 2019, 'descr' => '2018-2019','startdate' => '2018-09-01','enddate' => '2019-08-31','created_at' => now()],
            ['id' => 2020, 'descr' => '2019-2020','startdate' => '2019-09-01','enddate' => '2020-08-31','created_at' => now()],
            ['id' => 2021, 'descr' => '2020-2021','startdate' => '2020-09-01','enddate' => '2021-08-31','created_at' => now()],
            ['id' => 2022, 'descr' => '2021-2022','startdate' => '2021-09-01','enddate' => '2022-08-31','created_at' => now()],
        ]);
    }
}
