<div class="property-meta" style="margin-bottom:3em">

    @forelse ($development->tags_filter['servicios'] as $key => $tag)

        @if($key<5)

            <div class="property-meta-item">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;"
                     xml:space="preserve">
       <g>
           <g>
               <path d="M468.9,214.6c-11.4,0-20.7,9.3-20.7,20.7v20.8c0,54.3-21.2,105.4-59.7,143.8c-38.4,38.4-89.5,59.5-143.8,59.5
            c0,0-0.1,0-0.1,0c-112.2-0.1-203.4-91.4-203.3-203.5c0-54.3,21.2-105.4,59.7-143.8c38.4-38.4,89.5-59.5,143.8-59.5
            c0,0,0.1,0,0.1,0c28.7,0,56.5,5.9,82.7,17.6c10.4,4.7,22.7,0,27.3-10.5c4.6-10.4,0-22.7-10.5-27.3c-31.5-14-65-21.2-99.5-21.2
            c-0.1,0-0.1,0-0.1,0c-65.3,0-126.8,25.4-173,71.6C25.5,129,0,190.5,0,255.9C0,321.2,25.4,382.7,71.6,429s107.7,71.8,173.1,71.8
            c0.1,0,0.1,0,0.1,0c65.3,0,126.8-25.4,173-71.6c46.3-46.2,71.8-107.7,71.8-173.1v-20.8C489.6,223.9,480.3,214.6,468.9,214.6z"/>
           </g>
       </g>
                    <g>
                        <g>
                            <path d="M505.9,39.8c-8.1-8.1-21.2-8.1-29.2,0L244.8,271.7l-52.6-52.6c-8.1-8.1-21.2-8.1-29.2,0c-8.1,8.1-8.1,21.2,0,29.2
            l67.2,67.2c4,4,9.3,6.1,14.6,6.1s10.6-2,14.6-6.1L505.9,69.1C514,61,514,47.9,505.9,39.8z"/>
                        </g>
                    </g>
</svg>


                <div style="margin-top:-10px">

                    <span class="property-meta-number" style="font-size:11pt">{{$tag->name}}</span>

                </div>
            </div>

        @endif

    @empty
        @foreach ($development->tags_filter['ambientes'] as $key => $tag)
            @if($key<5)

                <div class="property-meta-item">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;"
                         xml:space="preserve">
       <g>
           <g>
               <path d="M468.9,214.6c-11.4,0-20.7,9.3-20.7,20.7v20.8c0,54.3-21.2,105.4-59.7,143.8c-38.4,38.4-89.5,59.5-143.8,59.5
            c0,0-0.1,0-0.1,0c-112.2-0.1-203.4-91.4-203.3-203.5c0-54.3,21.2-105.4,59.7-143.8c38.4-38.4,89.5-59.5,143.8-59.5
            c0,0,0.1,0,0.1,0c28.7,0,56.5,5.9,82.7,17.6c10.4,4.7,22.7,0,27.3-10.5c4.6-10.4,0-22.7-10.5-27.3c-31.5-14-65-21.2-99.5-21.2
            c-0.1,0-0.1,0-0.1,0c-65.3,0-126.8,25.4-173,71.6C25.5,129,0,190.5,0,255.9C0,321.2,25.4,382.7,71.6,429s107.7,71.8,173.1,71.8
            c0.1,0,0.1,0,0.1,0c65.3,0,126.8-25.4,173-71.6c46.3-46.2,71.8-107.7,71.8-173.1v-20.8C489.6,223.9,480.3,214.6,468.9,214.6z"/>
           </g>
       </g>
                        <g>
                            <g>
                                <path d="M505.9,39.8c-8.1-8.1-21.2-8.1-29.2,0L244.8,271.7l-52.6-52.6c-8.1-8.1-21.2-8.1-29.2,0c-8.1,8.1-8.1,21.2,0,29.2
            l67.2,67.2c4,4,9.3,6.1,14.6,6.1s10.6-2,14.6-6.1L505.9,69.1C514,61,514,47.9,505.9,39.8z"/>
                            </g>
                        </g>
</svg>


                    <div style="margin-top:-10px">

                        <span class="property-meta-number" style="font-size:11pt">{{$tag->name}}</span>

                    </div>
                </div>

            @endif

        @endforeach
    @endforelse

</div>