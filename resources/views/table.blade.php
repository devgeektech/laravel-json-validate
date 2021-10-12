@extends('layouts.app')
@section('content')
@php $filename = env('FILE_STORE_NAME',null); @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Table') }}
                    <span class="float-right"> <a href="{{route('home')}}">{{ __('Upload File') }}</a></span>
                </div>               
                <div class="card-body">
                    <table class="table">
                        @if(!empty($data))
                            @foreach($data as $key=>$value)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <button class="float-right btn btn-sm btn-primary mb-3" onclick="exportTableToCSV('{{$filename}}.csv')">Export CSV</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function exportTableToCSV(filename) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");        
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");            
            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);            
            csv.push(row.join(","));        
        }
        downloadCSV(csv.join("\n"), filename);
    }
    function downloadCSV(csv, filename) {
        var csvFile
        var downloadLink;
        csvFile = new Blob([csv], {type: "text/csv"});
        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    }
</script>
@endsection
