<?php

function rupiah($angka)
{

	$hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
	echo $hasil_rupiah;
}

function percentage($angka)
{

	$bulat = round($angka);

	echo $bulat; // Output: 12,345.679

}
