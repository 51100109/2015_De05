                                    <div class="form-group">
                                        <label class="control-label" for="id_category">Danh mục phần mềm</label> 
                                        <select name="id_category" id="id_category" class="form-control">
                                                <option value="">Danh mục</option>
                                                    @if(!empty($system))                                    
                                                        @foreach(explode("\n",$system->id_category) as $category)
                                                            @if(!empty(Category::find($category)))
                                                                <option value="{{ $category }}">{{ Category::find($category)->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                        </select>
                                    </div>