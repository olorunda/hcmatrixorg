@if(isset($direct))

@if(count($pilots) > 0)
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-plane"></i> PILOT GOALS</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion1{{$direct->id}}" aria-multiselectable="true" role="tablist">
          @foreach($pilots as $pilot)
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1{{$direct->id}}{{$pilot->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1{{$direct->id}}{{$pilot->id}}" data-parent="#siteMegaAccordion1{{$direct->id}}" aria-expanded="false" aria-controls="pilotcollapsModal1{{$direct->id}}{{$pilot->id}}">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default">
                {{$pilot->commitment}}
              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1{{$direct->id}}{{$pilot->id}}" aria-labelledby="pilotHeadingModal1{{$direct->id}}{{$pilot->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        {{$pilot->objective}}
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Employee Comments</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        @if($pilot->emp_comment==NULL)
                        No comments yet.
                        @else
                        {{$pilot->emp_comment}}
                        @endif
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Line Manager Comment</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li>
                        
                        <?php $cmt = app('App\Http\Controllers\LMController')->getCommentd($direct->id, $pilot->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cma1{{$j}}{{$direct->id}}')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status{{$j}}"></i>
                        </p>
                        <div class="click2edit" id="cma1{{$j}}{{$direct->id}}" empid="{{$direct->id}}" goalid="{{$pilot->id}}" style="word-wrap: break-word;">
                          @if(count($cmt) > 0)
                          @if($cmt->lm_comment != NULL)
                          {{$cmt->lm_comment}}
                          @endif
                          @endif
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $j+=1;?>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@else
<h4 class="text-danger no-pilot">No Goals Assigned Yet</h4>
@endif

@else

@if(count($pilots) > 0)
<div class="row row-lg">
  <div class="col-md-12 col-xs-12">
    <div class="panel panel-bordered" style="margin-bottom: 4px;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-plane"></i> PILOT GOALS</h3>
      </div>
      <div class="panel-body">
        <div class="panel-group panel-group-simple" id="siteMegaAccordion1{{Auth::user()->id}}" aria-multiselectable="true" role="tablist">
          @foreach($pilots as $pilot)
          <div class="panel">
            <div class="panel-heading" id="pilotHeadingModal1{{Auth::user()->id}}{{$pilot->id}}" role="tab">
              <a class="panel-title" data-toggle="collapse" href="#pilotcollapsModal1{{Auth::user()->id}}{{$pilot->id}}" data-parent="#siteMegaAccordion1{{Auth::user()->id}}" aria-expanded="false" aria-controls="pilotcollapsModal1{{Auth::user()->id}}{{$pilot->id}}">
                <h5 class="text-warning">Commitment</h5>
              </a>
              <span class="text-default">
                {{$pilot->commitment}}
              </span>
            </div>
            <div class="panel-collapse collapse" id="pilotcollapsModal1{{Auth::user()->id}}{{$pilot->id}}" aria-labelledby="pilotHeadingModal1{{Auth::user()->id}}{{$pilot->id}}" role="tabpanel">
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Objectvie</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        {{$pilot->objective}}
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Employee Comments</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li style="word-wrap: break-word;">
                        @if($pilot->emp_comment==NULL)
                        No comments yet.
                        @else
                        {{$pilot->emp_comment}}
                        @endif
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2 col-xs-12">
                    <h5>Line Manager Comment</h5>
                  </div>
                  <div class="col-md-10 col-xs-12">
                    <ul>
                      <li>
                        
                        <?php $cmt = app('App\Http\Controllers\LMController')->getCommentd(Auth::user()->id, $pilot->id); ?>
                        <br>
                        <p>
                          <a href="javascript:void(0)" onclick="editComm('cma1{{$j}}{{Auth::user()->id}}')" id="edit"><i class="icon wb-edit"></i></a>
                          <i class="hide" id="status{{$j}}"></i>
                        </p>
                        <div class="click2edit" id="cma1{{$j}}{{Auth::user()->id}}" empid="{{Auth::user()->id}}" goalid="{{$pilot->id}}" style="word-wrap: break-word;">
                          @if(count($cmt) > 0)
                          @if($cmt->lm_comment != NULL)
                          {{$cmt->lm_comment}}
                          @endif
                          @endif
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php $j+=1;?>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@else
<h4 class="text-danger no-pilot">No Goals Assigned Yet</h4>
@endif

@endif