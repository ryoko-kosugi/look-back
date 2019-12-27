@extends('layouts.app')

@section('content')

<div class="mt-4 row">
    <div class="ml-3 col-sm-9">
        
        <form action="#" method = "POST">
            <div class="form-group row">
                <label class="col-sm-3 col-form-lavel">date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="date" required>
                </div>
            </div>

            <div class="mb-5 form-group form-row">
                <label class="col-sm-3 col-form-lavel">total work time</label>
                <div class="col">
                    <input type="text" pattern="\d*" class="form-control" name="time" placeholder="hour" required>
                </div>
                <div class="col">
                    <select class="custom-select">
                      <option selected>minute</option>
                      <option value="1">00</option>
                      <option value="2">10</option>
                      <option value="3">20</option>
                      <option value="3">30</option>
                      <option value="3">40</option>
                      <option value="3">50</option>
                    </select>
                </div>
                <div class="col"></div>
            </div>                    
        
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">important</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="title" placeholder="max:280"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">free</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="content" placeholder="max:10000" ></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-3 col-9">
                    <button type="submit" class="btn btn-block btn btn-info">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

    
@endsection