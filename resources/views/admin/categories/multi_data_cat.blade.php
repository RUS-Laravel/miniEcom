
<h4 class="header-title">Category List</h4>
                        <p class="sub-header font-13">
                            
                        </p>

                        <div class="custom-dd dd" id="nestable_list_1">
                            <ol class="dd-list">
                                <li class="dd-item" data-id="">
                                    <div class="dd-handle">
                                        Choose a category
                                    </div>
                                </li>
                                @foreach ($parents as $child)
                                <li class="dd-item" data-id="{{$child->id}}">

                                    <div class="dd-handle">
                                        {{$child->name ?? ''}} --
                                        <a href="javascript:void()"
                                                data-control="edit-button" data-id="{{ $child->id }}"
                                                data-url="{{ route('admin.categories.edit', $child->id) }}">Edit
                                        </a> 
                                        @if (count($child->categories) == 0)
                                        | <a href="javascript:void()" 
                                            data-control="delete-button" data-id="{{ $child->id }}" 
                                            data-url="{{ route('admin.categories.delete', $child->id) }}">Delete
                                        </a>
                                        @endif
                                    </div>
                                    @foreach ($child->categories as $c)
                                    <ol class="dd-list" data-parent="{{$c->id ?? ''}}">
                                        <li class="dd-item" data-cid="{{$c->id ?? ''}}">

                                            <div class="dd-handle">
                                                {{$c->name ?? ''}} --
                                                <a href="javascript:void()"
                                                    data-control="edit-button" data-id="{{ $c->id }}"
                                                    data-url="{{ route('admin.categories.edit', $c->id) }}">Edit
                                                </a> | 
                                            <a href="javascript:void()" 
                                                data-control="delete-button" data-id="{{ $c->id }}" 
                                                data-url="{{ route('admin.categories.delete', $c->id) }}">Delete
                                            </a>
                                            </div>
                                        </li>
                                    </ol>
                                    @endforeach
                                </li>
                                @endforeach
                             
                            </ol>
                        </div>
