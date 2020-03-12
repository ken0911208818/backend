@extends('layouts.nav')
@section('content')
  <section class="mbr-section form1 cid-rSTUhymAJc mt-5 pt-5" id="form1-3">




    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    CONTACT FORM
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Easily add subscribe and contact forms without any server-side integration.
                </h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" data-form-type="formoid">
                <!---Formbuilder Form--->
                <form action="home/contentus" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form"><input type="hidden" name="email" data-form-email="true" value="QRKoMAD9d5BXOvdqcV9DL0fiSM9bKmXsebt5JCXNFQLM3AZlcIzqFy7HmsSDz+jabviuiTOn7SdNdS0S9yIGSVKWGO4fiDlwLI35rOk6lf8KIxs4qLxILClhToqs2nLo">
                    <div class="row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-md-4  form-group" data-for="name">
                            <label for="name-form1-3" class="form-control-label mbr-fonts-style display-7">Name</label>
                            <input type="text" name="name" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-3">
                        </div>
                        <div class="col-md-4  form-group" data-for="email">
                            <label for="email-form1-3" class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-3">
                        </div>
                        <div data-for="phone" class="col-md-4  form-group">
                            <label for="phone-form1-3" class="form-control-label mbr-fonts-style display-7">Phone</label>
                            <input type="tel" name="phone" data-form-field="Phone" class="form-control display-7" id="phone-form1-3">
                        </div>
                        <div data-for="message" class="col-md-12 form-group">
                            <label for="message-form1-3" class="form-control-label mbr-fonts-style display-7">Message</label>
                            <textarea name="message" data-form-field="Message" class="form-control display-7" id="message-form1-3"></textarea>
                        </div>
                        <div class="col-md-12 input-group-btn align-center">
                            <button type="submit" class="btn btn-primary btn-form display-4">SEND FORM</button>
                        </div>
                    </div>
                </form><!---Formbuilder Form--->
            </div>
        </div>
    </div>
</section>

@endsection
