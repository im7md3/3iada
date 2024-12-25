@extends('front.layouts.front')
@section('title')
    {{ __('Employee discounts') }}
@endsection
@section('content')
<section class="Financial-report main-section pt-5">
  <div class="container">
    <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
      <div class="d-flex mb-3">
        <a href="{{ route('front.reports') }}" class="btn bg-main-color text-white">
          <i class="fas fa-angle-right"></i>
        </a>
      </div>
      <h4 class="main-heading"> {{ __('Employee discounts') }}</h4>
      <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-3">
        <div class="form-group mb-2 mb-md-0 gap-3">
          <div class="row mt-3">
            <div class="col-md-4">
              <div class="form-group">
                <label for="from" class="small-label mb-2">{{ __('admin.from') }}</label>
                <input type="date" id="from" class="form-control" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="to" class="small-label mb-2">{{ __('admin.to') }}</label>
                <input type="date" id="to" class="form-control" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="name_employee" class="small-label mb-2">{{ __('Search name employee') }}</label>
                <input type="text" id="name_employee" class="form-control" >
              </div>
            </div>
          </div>

        </div>

        <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between ">
          <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
            <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
              <i class="fa-solid fa-print"></i>
              <span>{{ __('admin.print') }}</span>
            </button>
            <button class="btn btn-sm btn-outline-info" wire:click='export()'>
              <i class="fa-solid fa-file-excel"></i>
              <span>{{ __('admin.Export') }} Excel</span>
            </button>
          </div>
        </div>
      </div>
      <div id="prt-content">
        <x-header-invoice></x-header-invoice>

        <div class="table-responsive">
          <table class="table main-table">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('Invoice no.')}}</th>
                <th>{{ __('category')}}</th>
                <th>{{ __('employee')}}</th>
                <th>{{ __('Therapeutic service')}}</th>
                <th>{{ __('Service amount')}}</th>
                <th>{{ __('Date/time')}}</th>
                <th class="not-print">{{ __('actions')}}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="" title="عرض" class="btn btn-sm btn-purple">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <button class="btn btn-sm btn-danger" title="حذف">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

@push('js')
<script>
    function printData() {
        let divToPrint = document.getElementById("data-table");
        newWin = window.open("");
        newWin.document.head.replaceWith(document.head.cloneNode(true));
        newWin.document.body.appendChild(divToPrint.cloneNode(true));
        setTimeout(() => {
            newWin.print();
            newWin.close();
        }, 600);
    }
    document.getElementById("print-btn").addEventListener("click", printData);

    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;
        csv_file = new Blob(["\uFEFF" + csv], {
            type: "text/csv"
        });
        download_link = document.createElement("a");
        download_link.download = filename;
        download_link.href = window.URL.createObjectURL(csv_file);
        download_link.style.display = "none";
        document.body.appendChild(download_link);
        download_link.click();
    }

    function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            data.push(row.join(","));
        }
        downloadCSVFile(data.join("\n"), filename);
    }
    document.getElementById("export-btn").addEventListener("click", function() {
        var html = document.getElementById("data-table").outerHTML;
        htmlToCSV(html, "report.csv");
    });
</script>
@endpush
@endsection
