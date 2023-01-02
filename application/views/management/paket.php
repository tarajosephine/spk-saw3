<!-- Start Content-->
<div class="container-fluid">

	<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<div class="page-title-right">
					<form class="d-flex">
						<div class="input-group">
							<input type="text" class="form-control form-control-light" id="dash-daterange">
							<span class="input-group-text bg-primary border-primary text-white">
								<i class="mdi mdi-calendar-range font-13"></i>
							</span>
						</div>
					</form>
				</div>
				<h4 class="page-title">Data Paket Wedding</h4>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">

					<h4 class="header-title"><?= $title; ?></h4>
					<p class="text-muted font-14">
						Menu ini digunakan untuk data Paket Wedding
					</p>
					<button type="button" class="btn btn-primary mb-3" data-toggle="modal" onclick="inputDataBaruPaket()"
						data-target="#inputModal">Tambah Paket Wedding</button>
					<table id="datatable" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">Kode Paket</th>
								<th scope="col">Paket</th>
								<th scope="col">Harga</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody></tbody>
					</table>
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	<!-- end row-->

</div>
<!-- container -->

<!-- Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="dataModalLabel">Tambah Data</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class="btn btn-close">
				</button>
			</div>
			<form method="post" id="formData">
				<input type="hidden" id="validasi" name="validasi">
				<div class="modal-body">
					<div class="form-floating mb-2">
						<input type="text" class="form-control" id="kd_paket" name="kd_paket" placeholder="Kode Paket Wedding" readonly />
						<label for="floatingInput">Kode Paket Wedding</label>
					</div>

					<div class="form-floating mb-2">
						<input type="text" class="form-control input input1" id="paket" name="paket"
							placeholder="Masukkan Nama Paket" />
						<label for="floatingInput">Nama Paket</label>
					</div>

					<div class="form-floating mb-2">
						<input type="number" class="form-control input input2" id="harga" name="harga"
							placeholder="Masukkan Harga Paket" />
						<label for="floatingInput">Harga Paket</label>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="text" class="form-control input input3" id="dekorasi" name="dekorasi"
									placeholder="Masukkan Nama Dekorasi" />
								<label for="floatingInput">Nama Dekorasi</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="number" class="form-control input input4" id="harga_dekorasi" name="harga_dekorasi"
									placeholder="Masukkan Harga" />
								<label for="floatingInput">Harga</label>
							</div>
						</div>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="text" class="form-control input input5" id="brp" name="brp"
									placeholder="Masukkan Nama Busana Dan Rias Pengantin" />
								<label for="floatingInput">Nama Busana & Rias</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="number" class="form-control input input6" id="harga_brp" name="harga_brp"
									placeholder="Masukkan Harga" />
								<label for="floatingInput">Harga</label>
							</div>
						</div>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="text" class="form-control input input7" id="catering" name="catering"
									placeholder="Masukkan Nama Catering" />
								<label for="floatingInput">Nama Catering</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="number" class="form-control input input8" id="harga_catering" name="harga_catering"
									placeholder="Masukkan Harga" />
								<label for="floatingInput">Harga</label>
							</div>
						</div>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="text" class="form-control input input9" id="dokumentasi" name="dokumentasi"
									placeholder="Masukkan Nama Dokumentasi" />
								<label for="floatingInput">Nama Dokumentasi</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="number" class="form-control input input10" id="harga_dokumentasi" name="harga_dokumentasi"
									placeholder="Masukkan Harga" />
								<label for="floatingInput">Harga</label>
							</div>
						</div>
					</div>

					<div class="row g-2 mb-2">
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="text" class="form-control input input11" id="ah" name="ah"
									placeholder="Masukkan Nama Akomodasi Dan Hiburan" />
								<label for="floatingInput">Nama Akomodasi & Hiburan</label>
							</div>
						</div>
						<div class="col-md">
							<div class="form-floating mb-2">
								<input type="number" class="form-control input input12" id="harga_ah" name="harga_ah"
									placeholder="Masukkan Harga" />
								<label for="floatingInput">Harga</label>
							</div>
						</div>
					</div>

					<div class="form-floating mb-2">
						<input type="number" class="form-control input input13" id="jumlah_tamu" name="jumlah_tamu"
							placeholder="Masukkan Jumlah Tamu" />
						<label for="floatingInput">Jumlah Tamu</label>
					</div>

					<div class="form-floating mb-2">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-success" id="submit-data-paket">Tambahkan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		loaddata();
	});

	function loaddata(){
		$('#datatable').DataTable({
			processing: true,
			responseive: true,
			ajax: {
				"url": "<?= base_url('management/tablePaket') ?>",
				"type": "GET"
			},
			columns: [
				{ data: 'kd_paket', name: 'kd_paket' },
				{ data: 'paket', name: 'paket' },
				{ data: 'harga', name: 'harga' },
				{ data: 'kd_paket', 
					render: function(data, type, row, meta){
						return `
							<div class="dropdown float-end">
								<a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-dots-vertical font-18"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<a class="dropdown-item" href="<?= base_url(); ?>management/showPaket/${row.kd_paket}"><i
											class="mdi mdi-clipboard-text me-1"></i> Detail </a>
									<!-- item-->
									<button class="dropdown-item" data-toggle="modal" data-target="#inputModal"
										data-id="${row.kd_paket}" onclick="showPaket('${row.kd_paket}')"><i
											class="mdi mdi-pencil me-1"></i> Edit </button>
									<!-- item-->
									<button class="dropdown-item" data-id="${row.kd_paket}" id="delete-data-paket"><i
											class="mdi mdi-delete me-1"></i> Hapus </button>
								</div>
							</div>
						`;
					}
				}
			]
		});
	}
</script>
