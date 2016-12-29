                <div class="well">
                    <i class='fa fa-paperclip fa-2x pull-right' aria-hidden='true'></i>
                    <h5>Pinned Post</h5>
                    @if($pinned)
                        <h3><a href="{{route('slug', $pinned->slug)}}">{{$pinned->title}}</a></h3>
                    @else
                        <h4>No post is currently pinned.</h4>
                    @endif
                    <!-- /.input-group -->
                </div>


                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Popular Posts</h4>
                    <table class='table'>
                        @if($popular)
                            <?php $count = 0;?>
                            @foreach($popular as $p)
                                <?php $count+=1; ?>
                                <tr>
                                    <td><?php echo $count;?></td>
                                    <td><a href="{{ route('slug', $p->slug)}}">{{$p->title}}<a></td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4><a class='link-header' href="{{ route('categories.index') }}">Browse Categories</a></h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a class='link-sidebar' href="{{ route('categories.show', 1) }}">Counter-Strike</a></li>
                                <li style='margin-top:15px'><a class='link-sidebar' href="{{ route('categories.show', 3) }}">Rankings</a></li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a class='link-sidebar' href="{{ route('categories.show', 2) }}">Other Sports</a></li>
                                <li style='margin-top:15px'><a class='link-sidebar' href="{{ route('categories.show', 4) }}">Off-Topic</a></li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>About Me</h4>
                    <p>Ragamuffin is a Counter-Strike expert who has been following the competitive CS scene since 2004. He has a passion for competitive CS:GO and a severe inability to play it.  He is also a computer engineer by day.</p>
                    <h5><strong>Find & follow me on:</strong></h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li>
                                    <img src="/twitter_logo.ico" height='15px' width='15px'>                                
                                    <a class='link-header' href="https://twitter.com/RagamuffinCS">Twitter</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li>
                                    <img src="/hltv_logo.png" height='15px' width='15px'>
                                    <a class='link-header' href="http://www.hltv.org/?pageid=14&userid=77754">HLTV</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

            </div>
