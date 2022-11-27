@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Add Taxes') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="/addTaxes/<?php echo $id ?>" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-danger" role="alert">
                            <span class="alert-text text-white">
                            {{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <span class="m-4">
                                <input type="checkbox" id="T1" name="1">
                                <label for="T1">T1</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T2" name="2">
                                <label for="T2">T2</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T3" name="3">
                                <label for="T3">T3</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T4" name="4">
                                <label for="T4">T4</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T5" name="5">
                                <label for="T5">T5</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T6" name="6">
                                <label for="T6">T6</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T7" name="7">
                                <label for="T7">T7</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T8" name="8">
                                <label for="T8">T8</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T9" name="9">
                                <label for="T9">T9</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T10" name="10">
                                <label for="T10">T10</label>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span class="m-4">
                                <input type="checkbox" id="T11" name="11">
                                <label for="T11">T11</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T12" name="12">
                                <label for="T12">T12</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T13" name="13">
                                <label for="T13">T13</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T14" name="14">
                                <label for="T14">T14</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T15" name="15">
                                <label for="T15">T15</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T16" name="16">
                                <label for="T16">T16</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T17" name="17">
                                <label for="T17">T17</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T18" name="18">
                                <label for="T18">T18</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T19" name="19">
                                <label for="T19">T19</label>
                            </span>

                            <span class="m-4">
                                <input type="checkbox" id="T20" name="20">
                                <label for="T20">T20</label>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Add Taxes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
