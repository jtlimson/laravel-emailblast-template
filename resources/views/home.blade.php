@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    {{__('How-To-Use')}}
                </div>

                <div class="card-body"> 
                    <h2>  {{__('READ ME')}} </h2>
                    <hr />
                   <!-- TODO: 
                    -
                    -
                    -->
                    <h4>Mailing-List</h4>
                    <ul>
                        <li> Import CSV File from Batches menu and select Import CSV from the sub menu (Batches->Import CSV)
                            <ul>
                                <li>
                                Select batch name from drop box (you can also create your own batch name)
                                </li>
                                <li>
                                Choose the CSV file <input type="file" disabled/> (see. csv format before importing click <a href="#"> here </a>)
                                </li>
                                <li>
                                Then Save
                                </li>
                            </ul>
                        </li>
                        <li> Create Batch from Batches menu and select create from the sub menu (Batches->Create)
                            <ul>
                                <li>
                                Name your batch
                                </li>                                
                                <li>
                                Then Save
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <h4>Template</h4>
                    <ul>
                        <li>
                        Create Template from Template Menu and select create from the sub menu (Template->Create)
                            <ul>
                                <li>Select a category in the dropdown list </li>
                                <li>Name you subject</li>
                                <li>Compose your email-letter body</li>
                                <li>Then Save</li>
                            </ul>
                        </li>
                        <li>
                        Create Category <span style="color:red">(todo)</span>
                        </li>
                    </ul>
                    <h4>Sending the E-mail</h4>
                    <ul>
                        <li>
                            Select the desired template you want to send
                        </li>
                        <li>
                            Select the recepients
                        </li>
                        <li>
                            Select <button class="btn btn-primary" style="margin-top: 2px;">Preview</button> if you want to review the email letter
                        </li>
                        <li>
                           Select <button class="btn btn-primary" style="margin-top: 2px;">Test-Email</button> if you want to test the email letter
                        </li>
                        <li>
                            Select <button class="btn btn-success" style="margin-top: 2px;">Create Job</button> if you want to send the emails
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
