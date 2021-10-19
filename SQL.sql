CREATE DATABASE QUANLYNHAHANG

GO

USE QUANLYNHAHANG

GO

--NHAHANG
Create table NhaHang
( IDNhaHang int identity(1,1) primary key,
TenNhaHang nvarchar(50), 
DiaChi nvarchar(50));

--CONGVIEC
CREATE TABLE CongViec
(IDCongViec int identity(1,1) primary key,
TenCongViec nvarchar(50) not null, 
TienCongTheoNgay float)

--MONAN
CREATE TABLE MonAn
(IDMonAn int identity(1,1) primary key, 
TenMonAn nvarchar(50) not null,
SoDu int default 0, 
ChiPhiSanXuat float,
GiaBan float,
GiamGia float default 0)

--NHANVIEN
CREATE TABLE NHANVIEN
(IDNV int identity(1,1) primary key, 
IDCongViec int,
TenNV nvarchar(50) not null , 
SDT varchar(50), 
DiaChi nvarchar(50),  
Luong float,
IDNhaHang int,
foreign key (IDCongViec) references CONGVIEC(IDCongViec),
foreign key (IDNhaHang) references NhaHang(IDNhaHang)
)

--HOADON
CREATE TABLE HoaDon
(IDHoaDon int identity(1,1) primary key, 
TenMonAn nvarchar(50) not null, 
SoLuong int, 
GiaGoc float,
SoTienPhaiTra float,
TienLai float,
Ngay date default getdate(), 
IDMonAn int,
foreign key (IDMonAn) references MonAn(IDMonAn))

--LICHSUBAN
CREATE TABLE LichSuBan
( IDLichSuBan int identity(1,1) primary key, 
ChiPhiBoRa float , 
SoTienThuDuoc float, 
SoTienLai float, 
IDHoaDonCuoi int, 
IDNhaHang int,
Ngay date default getdate(),
foreign key (IDHoaDonCuoi) references HoaDon(IDHoaDon),
foreign key (IDNhaHang) references NhaHang(IDNhaHang))

--TAIKHOAN
Create table TaiKhoan
( IDTaiKhoan int identity(1,1) primary key, 
TenTaiKhoan varchar(50) not null, 
MatKhau varchar(50) not null, 
IDNV int,
foreign key (IDNV) references NhanVien(IDNV))

GO
--FUNCTION
--1 Tính tổng chi phí bỏ ra dựa trên các ngày của hóa đơn
Create Function chiPhiBoRa (@ngay date)
returns float
as begin
declare @chiphi float;
select @chiphi = sum(GiaGoc) from HoaDon where Ngay = @ngay;
return @chiphi;
end;
GO
--2 Tính tổng tiền thu được dựa trên các ngày của hóa đơn
Create Function tienThuDuoc (@ngay date)
returns float
as begin
declare @chiphi float;
select @chiphi = sum(SoTienPhaiTra) from HoaDon where Ngay = @ngay;
return @chiphi;
end
GO
--3 Tính tông tiền lãi dựa trên các ngày của hóa đơn
Create Function tienLai (@ngay date)
returns float
as begin
declare @chiphi float;
select @chiphi = sum(TienLai) from HoaDon where Ngay = @ngay;
return @chiphi;
end
GO
--4 Trả về công viêc của tài khoản nếu không phải là leader thì sẽ trả về 0 , là leader sẽ trả về 1
create function login_phan_quyen (@taikhoan varchar(50))
returns int
as begin
declare @IDCongViec int;
declare @IDNV int;
set @IDCongViec = 0;
select @IDNV = IDNV from TaiKhoan where TenTaiKhoan = @taikhoan;
select @IDCongViec = IDCongViec from NHANVIEN where IDNV = @IDNV;
return @IDCongViec
end

GO
-- TRIGGER
/*
--1 Dùng để thêm tài khoản đăng nhập vào website nhà hàng , mỗi khi thêm hoặc cập nhật 1 nhân viên
mặc định tài khoản sẽ là số điện thoại của nhân viên đó và mật khẩu là 123
*/
Create TRIGGER addNV
on NHANVIEN for INSERT
AS begin
if((exists(select SDT from inserted)) and ((select SDT from inserted) != ''))
begin
declare @SDT varchar(50);
select @SDT = SDT from inserted;
	Declare @taikhoan varchar(50);
	select @taikhoan = @SDT;
	Declare @IDNV int ;
	select @IDNV = IDNV from inserted;
	INSERT INTO TaiKhoan (TenTaiKhoan,MatKhau,IDNV) values (@taikhoan,'123',@IDNV);
end
end


GO


/*
2. Mỗi khi thêm 1 hóa đơn thì số tiền phải trả sẽ được tự động tính,
Số dư của món ăn đó tự động giảm đi ,
Chi phí bỏ ra , Số tiền thu được và số tiền lãi sẽ tự động cập nhật trong lịch sử bán
*/

CREATE TRIGGER addHoaDon
on HoaDon for insert
as
Declare @soLuong float;
select @soLuong = SoLuong from inserted;
Declare @idMonAn int;
select @idMonAn = IDMonAn from inserted;
Declare @idHoaDon int;
select @idHoaDon = IDHoaDon from inserted;
Declare @ngay date;
select @ngay = Ngay from inserted;
if(exists(select IDMonAn from MonAn where IDMonAn = @idMonAn) 
and @soLuong > 0 
and (select SoDu from MonAn where IDMonAn = @idMonAn) >= @soLuong)
begin
UPDATE HoaDon 
set SoTienPhaiTra = (@soLuong * (select GiaBan from MonAn where IDMonAn = @idMonAn)) 
- (@soLuong * (select GiaBan from MonAn where IDMonAn = @idMonAn) * ((select GiamGia from MonAn where IDMonAn =@idMonAn) / 100)) 
where IDHoaDon = @idHoaDon;
UPDATE HoaDon
set GiaGoc = @soLuong * (select ChiPhiSanXuat from MonAn where IDMonAn = @idMonAn) where IDHoaDon = @idHoaDon;
UPDATE HoaDon
set TienLai = SoTienPhaiTra - GiaGoc where IDHoaDon = @idHoaDon;
UPDATE MonAn
set SoDu = SoDu - @soLuong where IDMonAn = @idMonAn;
--Thêm vào lịch sử bán dựa theo ngày của hóa đơn , sử dụng các hàm được định nghĩa ở trên
Insert into LichSuBan (ChiPhiBoRa,SoTienThuDuoc,SoTienLai,IDHoaDonCuoi,IDNhaHang,ngay)
values(dbo.chiPhiBoRa(@ngay),dbo.tienThuDuoc(@ngay),dbo.tienLai(@ngay),@idHoaDon,1,@ngay);
end
else
rollback tran;


GO
--PROCEDURE
--1 Proc này dùng để order món ăn , tính vào trong hóa đơn
CREATE PROC orderMon @idmon int , @soluong int
as begin 
declare @tenmon nvarchar(50);
select @tenmon = TenMonAn from MonAn where IDMonAn = @idmon;
insert into HoaDon (IDMonAn,TenMonAn,SoLuong) values (@idmon,@tenmon,@soluong);
end

GO
--2 Proc này dùng để thêm nhân viên với số lương được tự động thêm từ công việc
CREATE PROC themNhanVien @IDCongViec int , @TenNV nvarchar(50) , @SDT char(10) , @DiaChi nvarchar(50) , @IDNhaHang int
as begin
declare @luong float ;
select @luong = (select CongViec.TienCongTheoNgay from CongViec where IDCongViec = @IDCongViec) * 30;
Insert into NHANVIEN values (@IDCongViec,@TenNV,@SDT,@DiaChi,@luong,@IDNhaHang);
end

GO
--3 Proc thêm món ăn
CREATE PROC themMonAn @TenMonAn nvarchar(50), @SoDu int , @ChiPhiSanXuat float , @GiaBan float , @GiamGia float
as begin
Insert into MonAn values (@TenMonAn,@SoDu,@ChiPhiSanXuat,@GiaBan,@GiamGia);
end

GO
--4 Proc thêm Công việc
CREATE PROC themCongViec @TenCongViec nvarchar(50), @TienCongTheoNgay float
as begin
Insert into CongViec values (@TenCongViec,@TienCongTheoNgay);
end

GO
--5 Proc thêm nhà hàng
CREATE PROC themNhaHang @TenNhaHang nvarchar(50), @DiaChi nvarchar(50)
as begin
Insert into NhaHang values (@TenNhaHang,@DiaChi);
end

GO
--VIEW 
-- View này dùng để xuất hóa đơn những thông tin cần thiết
Create view XuatHoaDon (TenMonAn , SoLuong , SoTienPhaiTra , Ngay)
AS Select TenMonAn,SoLuong,SoTienPhaiTra,Ngay from HoaDon

GO
--CURSOR
-- đưa ra những món ăn đã bán trong ngày và tổng số sượng đã bán , sử dụng view XuatHoaDon
Create function monAnBanTrongNgay (@day date)
returns nvarchar(1000)
AS BEGIN
declare @tonghop nvarchar(1000);
set @tonghop = '';
declare tenCacMonAn cursor dynamic for select distinct TenMonAn from XuatHoaDon;
open tenCacMonAn;
declare @ten nvarchar(50);
fetch first from tenCacMonAn into @ten
while (@@FETCH_STATUS = 0)
begin
declare @soluong int;
select @soluong = sum(SoLuong) from XuatHoaDon where TenMonAn like @ten and Ngay = @day;
set @tonghop = @tonghop + ( @ten + '(' + convert(nvarchar(10),@soluong) + ')' + ',');
fetch next from tenCacMonAn into @ten;
end
close tenCacMonAn;
deallocate tenCacMonAn;
return @tonghop;
END

GO
--Transaction
-- Thay đổi tiền công theo ngày trong bảng công việc trong lúc cập nhật luong nhân viên cũng sẽ không bị nhận dữ liệu bẩn
Create Proc update_luongCongViec @IDCongViec int , @TienCongTheoNgay float
as begin 
begin tran
Update CongViec set TienCongTheoNgay = @TienCongTheoNgay where IDCongViec = @IDCongViec;
commit tran
end

GO

Create Proc update_LuongNV @IDNhanVien int , @Luong float
as begin 
declare @IDCongViec int;
select @IDCongViec = IDCongViec from NHANVIEN where IDNV = @IDNhanVien;
begin tran
set tran isolation level read committed
Update NHANVIEN set Luong = 30 * (select TienCongTheoNgay from CongViec where IDCongViec = @IDCongViec);
commit tran
end

GO
--PHÂN QUYỀN

-- thêm 2 tài khoản login
exec sp_addlogin 'nhanvien','nhanvien'
exec sp_addlogin 'quanly','quanly'

GO
-- thêm 2 user cùng tên login vào database QUANLYNHAHANG
USE QUANLYNHAHANG
GO
sp_grantdbaccess 'nhanvien','nhanvien';
GO
sp_grantdbaccess 'quanly','quanly';

GO
--Tạo role quyen_nhanvien
--quyen_nhanvien có thể xem bảng MonAn và HoaDon
sp_addrole 'quyen_nhanvien'
GO
grant select on MonAn to quyen_nhanvien
grant select , insert on HoaDon to quyen_nhanvien
GO
--tạo role quyen_quanly
--quyen_quanly co them xem va sua bang MonAn , NhanVien , HoaDon , CongViec
sp_addrole 'quyen_quanly'
GO
grant select , update , insert , delete on MonAn to quyen_quanly
grant select , update , insert , delete on NHANVIEN to quyen_quanly
grant select , update , insert , delete on CongViec to quyen_quanly
grant select , insert on HoaDon to quyen_quanly
GO

-- cho tat ca duoc su dung cac proc , function
GRANT EXEC TO PUBLIC;
GO
--thêm user vào role
sp_addrolemember 'quyen_nhanvien','nhanvien'
GO
sp_addrolemember 'quyen_quanly','quanly'
GO


--Them du lieu
insert into CongViec values ('Leader',300000),('Bồi Bàn',150000),('Tạp Vụ',180000),('Thu Ngân',200000),('Đầu bếp',250000);
GO
insert into NhaHang values ('Rừng Và Biển' , 'Hà Nội');
GO
insert into MonAn values ('Gà Nướng',100,100000 ,150000 , 5),('Set Lẩu',100,300000 ,500000 , 0),('Bò Xào',100,90000 ,130000 , 10);
GO
exec dbo.orderMon 1,2
GO
exec dbo.themNhanVien 1,'Do Van Xuan','038853006','Ha Noi',1


/*
select * from NHANVIEN
select * from CongViec
select * from TaiKhoan
select * from MonAn
select * from NhaHang
select * from HoaDon
select * from LichSuBan
*/