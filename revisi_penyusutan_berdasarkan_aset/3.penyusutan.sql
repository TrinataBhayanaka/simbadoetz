
INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('976','201055','03.11.01.10.01','08.01.01.28','12.11.33.08.01.06.01.28','1','2006-10-11','2006-10-11','1','1','NULL','1','1','1','2006','284649686.0000','JL. SUTAN SYAHRIR NO. 16 PEKALONGAN','NULL','Hibah','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','41015120.0000','284649686.0000','4101512.0000','40','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.28','2017-03-19','2016-12-31','49','284649686.0000',41015120.0000,284649686.0000,4101512.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '46708114',	
                                            PenyusutanPerTaun = '5692994',
                                            NilaiBuku = '237941572',
                                            UmurEkonomis = '49',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '201055';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '46708114',	
                                            PenyusutanPerTahun = '5692994',
                                            NilaiBuku = '237941572',
                                            UmurEkonomis = '49',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '201055';

INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('976','201055','03.11.01.10.01','08.01.01.28','12.11.33.08.01.06.01.28','1','2006-10-11','2006-10-11','1','1','NULL','1','1','1','2006','284649686.0000','JL. SUTAN SYAHRIR NO. 16 PEKALONGAN','NULL','Hibah','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','46708114.0000','237941572.0000','5692994.0000','49','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.28','2017-03-19','2016-12-31','51','284649686.0000',41015120.0000,284649686.0000,4101512.0000);



INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1192','201271','03.11.01.01.01','08.01.01.77','12.11.33.08.01.98.01.77','1','1998-12-31','1998-12-31','1','1','NULL','1','1','1','1998','483132331.0000','Jl.Patriot No.32 Kel.Dukuh Kec.Pekalongan Utara
Kota Pekalongan','NULL','Pembelian','1','NULL','NULL','NULL','0','NULL','531','NULL','NULL','NULL','NULL','0','1998-12-31','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','145029276.0000','483132331.0000','8057182.0000','32','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.77','2017-03-19','2016-12-31','49','483132331.0000',145029276.0000,483132331.0000,8057182.0000);


UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '158086907',	
                                            PenyusutanPerTaun = '13057631',
                                            NilaiBuku = '325045424',
                                            UmurEkonomis = '36',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '201271';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '158086907',	
                                            PenyusutanPerTahun = '13057631',
                                            NilaiBuku = '325045424',
                                            UmurEkonomis = '36',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '201271';

INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1192','201271','03.11.01.01.01','08.01.01.77','12.11.33.08.01.98.01.77','1','1998-12-31','1998-12-31','1','1','NULL','1','1','1','1998','483132331.0000','Jl.Patriot No.32 Kel.Dukuh Kec.Pekalongan Utara
Kota Pekalongan','NULL','Pembelian','1','NULL','NULL','NULL','0','NULL','531','NULL','NULL','NULL','NULL','0','1998-12-31','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','158086907.0000','325045424.0000','13057631.0000','36','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.77','2017-03-19','2016-12-31','51','483132331.0000',145029276.0000,483132331.0000,8057182.0000);


INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('3558','2643984','03.11.01.10.01','08.01.04.01','12.11.33.08.01.60.04.01','3','1960-12-31','2015-01-01','NULL','1','0','1','1','1','1960','205462256.0000','Jl.Merak No.3 Pekalongan','NULL','NULL','1','NULL','NULL','NULL','2','0','72','NULL','NULL','NULL','NULL','NULL','0000-00-00','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','155462256.0000','205462256.0000','3109245.0000','0','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.04.01','2017-03-19','2016-12-31','49','205462256.0000',155462256.0000,205462256.0000,3109245.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '169159740',	
                                            PenyusutanPerTaun = '13697484',
                                            NilaiBuku = '36302516',
                                            UmurEkonomis = '14',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '2643984';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '169159740',	
                                            PenyusutanPerTahun = '13697484',
                                            NilaiBuku = '36302516',
                                            UmurEkonomis = '14',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '2643984';

INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('3558','2643984','03.11.01.10.01','08.01.04.01','12.11.33.08.01.60.04.01','3','1960-12-31','2015-01-01','NULL','1','0','1','1','1','1960','205462256.0000','Jl.Merak No.3 Pekalongan','NULL','NULL','1','NULL','NULL','NULL','2','0','72','NULL','NULL','NULL','NULL','NULL','0000-00-00','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','169159740.0000','36302516.0000','13697484.0000','14','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.04.01','2017-03-19','2016-12-31','51','205462256.0000',155462256.0000,205462256.0000,3109245.0000);


INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('3694','2644124','03.11.01.10.01','08.01.08.01','12.11.33.08.01.81.08.01','6','1981-12-31','2015-01-01','NULL','1','0','1','1','1','1981','348482916.0000','Jalan Seruni No. 59 Telepon 421259 Pekalongan','pecahan glondong','NULL','1','NULL','NULL','NULL','2','0','243','NULL','NULL','NULL','NULL','NULL','0000-00-00','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','146110615.0000','348482916.0000','4174589.0000','15','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','49','348482916.0000',146110615.0000,348482916.0000,4174589.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '153080273',	
                                            PenyusutanPerTaun = '6969658',
                                            NilaiBuku = '195402643',
                                            UmurEkonomis = '49',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '2644124';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '153080273',	
                                            PenyusutanPerTahun = '6969658',
                                            NilaiBuku = '195402643',
                                            UmurEkonomis = '49',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '2644124';
INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('3694','2644124','03.11.01.10.01','08.01.08.01','12.11.33.08.01.81.08.01','6','1981-12-31','2015-01-01','NULL','1','0','1','1','1','1981','348482916.0000','Jalan Seruni No. 59 Telepon 421259 Pekalongan','pecahan glondong','NULL','1','NULL','NULL','NULL','2','0','243','NULL','NULL','NULL','NULL','NULL','0000-00-00','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','153080273.0000','195402643.0000','6969658.0000','49','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','51','348482916.0000',146110615.0000,348482916.0000,4174589.0000);


INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('858','200937','03.11.01.10.01','08.01.01.01','12.11.33.08.01.13.01.01','87','2013-11-30','2013-11-30','3','1','NULL','1','1','1','2013','2135182490.0000','NULL','Gedung A Dindikpora','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','2013-11-30','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','99725361.0000','2135182490.0000','35817921.0000','49','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.01','2017-03-19','2016-12-31','49','2135182490.0000',99725361.0000,2135182490.0000,35817921.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '142429011',	
                                            PenyusutanPerTaun = '42703650',
                                            NilaiBuku = '1992753479',
                                            UmurEkonomis = '49',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '200937';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '142429011',	
                                            PenyusutanPerTahun = '42703650',
                                            NilaiBuku = '1992753479',
                                            UmurEkonomis = '49',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '200937';

INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('858','200937','03.11.01.10.01','08.01.01.01','12.11.33.08.01.13.01.01','87','2013-11-30','2013-11-30','3','1','NULL','1','1','1','2013','2135182490.0000','NULL','Gedung A Dindikpora','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','2013-11-30','NULL','NULL','NULL','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','142429011.0000','1992753479.0000','42703650.0000','49','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.01','2017-03-19','2016-12-31','51','2135182490.0000',99725361.0000,2135182490.0000,35817921.0000);


INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('992','201071','03.11.01.10.01','08.01.01.30','12.11.33.08.01.09.01.30','9','2009-12-31','2009-12-31','1','1','NULL','1','1','1','2009','470063875.2300','NULL','Gedung SDN Bumirejo','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','2009-12-31','NULL','NULL','Tanah Milik Pemda','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','56068019.0000','470063875.2300','8009717.0000','43','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.30','2017-03-19','2016-12-31','49','470063875.2300',56068019.0000,470063875.2300,8009717.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '65861016',	
                                            PenyusutanPerTaun = '9792997',
                                            NilaiBuku = '404202859.23',
                                            UmurEkonomis = '47',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '201071';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '65861016',	
                                            PenyusutanPerTahun = '9792997',
                                            NilaiBuku = '404202859.23',
                                            UmurEkonomis = '47',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '201071';
INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('992','201071','03.11.01.10.01','08.01.01.30','12.11.33.08.01.09.01.30','9','2009-12-31','2009-12-31','1','1','NULL','1','1','1','2009','470063875.2300','NULL','Gedung SDN Bumirejo','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','2009-12-31','NULL','NULL','Tanah Milik Pemda','NULL','NULL','0','NULL','NULL','NULL','NULL','NULL','NULL','50','65861016.0000','404202859.2300','9792997.0000','47','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.01.30','2017-03-19','2016-12-31','51','470063875.2300',56068019.0000,470063875.2300,8009717.0000);



INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1420','201499','03.11.01.10.01','08.01.08.01','12.11.33.08.01.08.08.01','4','2008-12-31','2008-12-31','1','1','NULL','1','1','1','2008','144921714.0000','Jl. Seruni No. 59 Pekalongan','Bangunan RKB 3 ruang kelas','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','18547472.0000','144921714.0000','2318434.0000','42','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','49','144921714.0000',18547472.0000,144921714.0000,2318434.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '21445906',	
                                            PenyusutanPerTaun = '2898434',
                                            NilaiBuku = '123475808',
                                            UmurEkonomis = '49',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '201499';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '21445906',	
                                            PenyusutanPerTahun = '2898434',
                                            NilaiBuku = '123475808',
                                            UmurEkonomis = '49',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '201499';
INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1420','201499','03.11.01.10.01','08.01.08.01','12.11.33.08.01.08.08.01','4','2008-12-31','2008-12-31','1','1','NULL','1','1','1','2008','144921714.0000','Jl. Seruni No. 59 Pekalongan','Bangunan RKB 3 ruang kelas','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','21445906.0000','123475808.0000','2898434.0000','49','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','51','144921714.0000',18547472.0000,144921714.0000,2318434.0000);


INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1421','201500','03.11.01.10.01','08.01.08.01','12.11.33.08.01.08.08.01','5','2008-12-31','2008-12-31','1','1','NULL','1','1','1','2008','272293361.0000','Jl. Seruni No. 59 Pekalongan','Rehab Gedung 3 R. Kelas','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','40206936.0000','272293361.0000','5025867.0000','42','2015','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','49','272293361.0000',40206936.0000,272293361.0000,5025867.0000);

UPDATE aset SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '46000412',	
                                            PenyusutanPerTaun = '5793476',
                                            NilaiBuku = '226292949',
                                            UmurEkonomis = '46',
                                             TahunPenyusutan='2016'     
                                            WHERE Aset_ID = '201500';
UPDATE bangunan SET MasaManfaat = '50' ,
                                            AkumulasiPenyusutan = '46000412',	
                                            PenyusutanPerTahun = '5793476',
                                            NilaiBuku = '226292949',
                                            UmurEkonomis = '46',
                                            TahunPenyusutan='2016'
                                            WHERE Aset_ID = '201500';
INSERT INTO log_bangunan (Bangunan_ID,Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan,kodeData,kodeKA,kodeRuangan,StatusValidasi,Status_Validasi_Barang,StatusTampil,Tahun,NilaiPerolehan,Alamat,Info,AsalUsul,kondisi,CaraPerolehan,TglPakai,Konstruksi,Beton,JumlahLantai,LuasLantai,Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,NoIMB,TglIMB,StatusTanah,NoSertifikat,TglSertifikat,Tanah_ID,Tmp_Tingkat,Tmp_Beton,Tmp_Luas,KelompokTanah_ID,GUID,TglPembangunan,MasaManfaat,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,nilai_kapitalisasi,prosentase,penambahan_masa_manfaat,jenis_belanja,kodeKelompokReklasAsal,kodeKelompokReklasTujuan,action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal) VALUES      ('1421','201500','03.11.01.10.01','08.01.08.01','12.11.33.08.01.08.08.01','5','2008-12-31','2008-12-31','1','1','NULL','1','1','1','2008','272293361.0000','Jl. Seruni No. 59 Pekalongan','Rehab Gedung 3 R. Kelas','Pembelian','1','NULL','NULL','NULL','0','NULL','0','NULL','NULL','NULL','NULL','0','0000-00-00','NULL','NULL','Tanah Milik Pemda','NULL','NULL','1','NULL','NULL','NULL','01.01.11.04.02','NULL','NULL','50','46000412.0000','226292949.0000','5793476.0000','46','2016','NULL','NULL','NULL','0','NULL','NULL','Penyusutan_2016_08.01.08.01','2017-03-19','2016-12-31','51','272293361.0000',40206936.0000,272293361.0000,5025867.0000);
