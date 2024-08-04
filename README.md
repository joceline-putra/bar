# JRN zoho.com

-- CALL sp_report_finance(1,'2022-04-01','2022-05-30',1,0,'');

SELECT
  `trans_id`,
  `trans_number`,
  `trans_date`,
  `trans_flag`,  
  `trans_paid`,  
  `trans_total_dpp`,
  `trans_discount`,
  `trans_return`,
  `trans_total`,
  `trans_total_paid`,
  `trans_fee`,
  -- `trans_paid_type`,
  -- `trans_session`,
  `trans_id_source`
FROM `trans`
LIMIT 0, 1000;


#DOMAIN NAME

	ACCOUNT
	invoices.id
	mypaper.id
	paperku.id
	kertasku.id
	kertasku.online
	kertaskerja.online
	paperless.cloud

doted.id

ketat.in
kepoo.in
bucin.in
mantul.in
mager.in
pargoy.in
gabut.in READY

	SHORT LINK
	singkat.in
	share.site
	mini.site/
	ketat.in
	cakep.in
	tipis.in
	freelink.site
	freelink.id
	ourlink.id
	wshare.id
	ushare.id
		fresite.id
		copaz.id
		copaz.in/32aA32
		minio.id  --TAKE IT @200k
		sorts.in/2s8AjU
		READY copaste.in/uYakQa2
		freeo.id

ACCOUNT_MAPS
#========
	2 = Ppn Keluaran
	3 = Uang Muka Penjualan
	4 = Retur Penjualan
	5 = Diskon Penjualan
	6 = Pendapatan Penjualan (COGS)
3 = Persediaan
	1 = Persediaan Umum
	2 = Persediaan Barang
	3 = Persediaan Rusak
FOR TRANSACTION
1 = Pembelian
	1 = Hutang Usaha
	2 = Ppn Masukan
	3 = Uang Muka Pembelian
	4 = Retur Pembelian
	5 = Diskon Pembelian
2 = Penjualan
	1 = Piutang Usaha
	4 = Persediaan Produksi
4 = Stok Opname
	1 = Stok Lebih
	2 = Stok Kurang

CONTACTS
#=======
1=Supplier
2=Customer
3=Employee
4=Patient
5=Insurance

ORDERS
#=======
1=PurchaseOrder
2=SalesOrder
3=PenawaranPembelian
4=PenawaranPenjualan
5=CheckUp Medicine
6=CheckUp Laboratory


TRANS
#=======
1=Pembelian
2=Penjualan
3=ReturPembelian
4=ReturPenjualan
5=MutasiStock
	6=StokOpnamePlus
	7=StokOpnameMinus
8=Production
9=PemakaianBarang
10=PemasukanBarang

JOURNALS
#=======
1=BayarHutang,
2=BayarPiutang,
3=KasMasuk,
4=KasKeluar,
5=Transfer Uang / MutasiKas,
6=UangMukaBeli,
7=UangMukaJual,
8=JurnalUmum,
9=KirimUang,
10=Pembelian,
11=Penjualan,
12=ReturPembelian,
13=ReturPenjualan,
14=OpnamePlus,
15=OpnameMinus,
16=AssetBeli,
17=AssetSusut,
18=AssetJual,


# Absensi
- branchs (Kantor)
- locations (Multi Titik Absensi)
- users (User, Karyawan)
- _attendances