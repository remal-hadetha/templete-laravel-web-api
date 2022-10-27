@if($errors)
@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endforeach
@endif
    <div class="block">
        <div class="block-header">
            <h3 class="block-title"> الآقسام الفرعية</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- Regular -->
            <h2 class="content-heading border-bottom mb-4 pb-2"></h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-username">الإسم <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="الإسم" @isset($data)
                        value="{{$data->name}}"
                            @endisset>
                    </div>
                    <div class="form-group">
                        <label for="val-skill">Category <span class="text-danger">*</span></label>
                        <select class="form-control" id="val-skill" name="category_id">
                            <option value="">Please select</option>
                            @forelse ($categories as $item)
                        <option value="{{$item->id}}" @isset($data)
                            @if($data->id == $item->id)
                            selected
                            @endif
                                @endisset>{{$item->name_ar}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="val-suggestions">الوصف <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="desc_ar" rows="5" placeholder="وصف القسم">@isset($data)
                            {{$data->desc_ar}}
                                @endisset</textarea>
                    </div>

                </div>
            </div>
            <!-- END Regular -->

            {{-- <!-- Advanced -->
            <h2 class="content-heading border-bottom mb-4 pb-2">Advanced</h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        You can easily validate any kind of data you like either it is in a normal input, a textarea or a select box
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-suggestions">Suggestions <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="val-suggestions" name="val-suggestions" rows="5" placeholder="What would you like to see?"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="val-skill">Best Skill <span class="text-danger">*</span></label>
                        <select class="form-control" id="val-skill" name="val-skill">
                            <option value="">Please select</option>
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JavaScript</option>
                            <option value="angular">Angular</option>
                            <option value="react">React</option>
                            <option value="vuejs">Vue.js</option>
                            <option value="ruby">Ruby</option>
                            <option value="php">PHP</option>
                            <option value="asp">ASP.NET</option>
                            <option value="python">Python</option>
                            <option value="mysql">MySQL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="val-currency">Currency <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="$21.60">
                    </div>
                    <div class="form-group">
                        <label for="val-website">Website <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-website" name="val-website" placeholder="http://example.com">
                    </div>
                    <div class="form-group">
                        <label for="val-phoneus">Phone (US) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-phoneus" name="val-phoneus" placeholder="212-999-0000">
                    </div>
                    <div class="form-group">
                        <label for="val-digits">Digits <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-digits" name="val-digits" placeholder="5">
                    </div>
                    <div class="form-group">
                        <label for="val-number">Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-number" name="val-number" placeholder="5.0">
                    </div>
                    <div class="form-group">
                        <label for="val-range">Range [1, 5] <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-range" name="val-range" placeholder="4">
                    </div>
                    <div class="form-group">
                        <a href="#" data-toggle="modal" data-target="#modal-terms">Terms &amp; Conditions</a> <span class="text-danger">*</span>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="val-terms" name="val-terms" value="1">
                            <label class="custom-control-label" for="val-terms">I agree</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Advanced -->

            <!-- Third Party Plugins -->
            <h2 class="content-heading border-bottom mb-4 pb-2">Third Party Plugins</h2>
            <div class="row items-push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        Check out how easy it is to enable the validation on third party plugins such as Select2
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <label for="val-select2">Select2 <span class="text-danger">*</span></label>
                        <select class="js-select2 form-control" id="val-select2" name="val-select2" style="width: 100%;" data-placeholder="Choose one..">
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JavaScript</option>
                            <option value="angular">Angular</option>
                            <option value="react">React</option>
                            <option value="vuejs">Vue.js</option>
                            <option value="ruby">Ruby</option>
                            <option value="php">PHP</option>
                            <option value="asp">ASP.NET</option>
                            <option value="python">Python</option>
                            <option value="mysql">MySQL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="val-select2-multiple">Select2 Multiple <span class="text-danger">*</span></label>
                        <select class="js-select2 form-control" id="val-select2-multiple" name="val-select2-multiple" style="width: 100%;" data-placeholder="Choose at least two.." multiple>
                            <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="html">HTML</option>
                            <option value="css">CSS</option>
                            <option value="javascript">JavaScript</option>
                            <option value="angular">Angular</option>
                            <option value="react">React</option>
                            <option value="vuejs">Vue.js</option>
                            <option value="ruby">Ruby</option>
                            <option value="php">PHP</option>
                            <option value="asp">ASP.NET</option>
                            <option value="python">Python</option>
                            <option value="mysql">MySQL</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- END Third Party Plugins --> --}}

            <!-- Submit -->
            <div class="row items-push">
                <div class="col-lg-7 offset-lg-4">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </div>
            <!-- END Submit -->
        </div>
    </div>
