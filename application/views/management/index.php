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
				<h4 class="page-title">Data Pelanggan</h4>
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
						Menu ini digunakan untuk menambah data pelanggan
					</p>
					<?= form_error('pelanggan', '<div class="alert alert-danger" role="alert">
										', '
										</div>'); ?>
					<?= $this->session->flashdata('message_pelanggan'); ?>
					<table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Nama</th>
								<th scope="col">No HP</th>
								<th scope="col">Email</th>
								<th scope="col">Alamat</th>
								<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($pelanggan as $p) : ?>
							<tr>
								<td scope="row"><?= $i; ?></td>
								<td><?= $p['nama']; ?></td>
								<td><?= $p['no_hp']; ?></td>
								<td><?= $p['email']; ?></td>
								<td><?= $p['alamat']; ?></td>
								<td>
									<div class="dropdown float-end">
										<a href="#" class="dropdown-toggle text-muted arrow-none"
											data-bs-toggle="dropdown" aria-expanded="false">
											<i class="mdi mdi-dots-vertical font-18"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal"
												data-target="#inputModal" data-id="<?= $p['id_pelanggan']; ?>"
												onclick="editPelanggan(`<?= $p['id_pelanggan']; ?>`)"><i
													class="mdi mdi-pencil me-1"></i> Edit </button>
											<!-- item-->
											<button class="dropdown-item" data-toggle="modal"
												data-target="#deleteModal" data-id="<?= $p['id_pelanggan']; ?>"
												onclick="deletePelanggan(`<?= $p['id_pelanggan']; ?>`)"><i
													class="mdi mdi-delete me-1"></i> Hapus </button>
										</div>
									</div>
								</td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div> <!-- end card body-->
			</div> <!-- end card -->
		</div><!-- end col-->
	</div>
	<!-- end row-->

</div>
<!-- container -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="DeleteModalLabel">Hapus Menu</h5>
				<button onclick="javascript:void(0);" data-dismiss="modal" class=" btn btn-close">
				</button>
			</div>
			<div class="modal-body">Apakah anda yakin ingin menghapus menu ini?</div>
			<form method="POST">
				<input type="hidden" name="id_s" id="id_s">
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>
