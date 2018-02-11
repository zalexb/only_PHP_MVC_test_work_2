<?
class Paginator
{
    protected $items;
    protected $total_items;
    protected $per_page;
    protected $last_page;
    protected $path = '/';

    public function __construct($items,$per_page,$path = '/'){
        $this->items = $items;
        $this->per_page = $per_page;
        $this->path = $path;
        $this->total_items = is_array($items) ? count($items): $items;
        $this->last_page = max((int) ceil($this->total_items / $per_page), 1);
    }

    public function currentPage(){

        $current_page = isset($_GET['page'])? $_GET['page'] : 1;

        return $current_page;
    }

    public function lastPage(){
        return $this->last_page;
    }

    public function url($page){
        $data = [];

        foreach ($_GET as $key=>$value){
            if($key!='page')
                $data[$key] = $value;
        }

            $data['page'] = $page;

        return $this->path.'?'.http_build_query($data);
    }

    static function paginate($db,$query,$per_page,$total_items,$path){

        $current_page = isset($_GET['page'])? $_GET['page'] : 1;

        $start = $current_page * $per_page - $per_page;

        $query = $query.' LIMIT '.$start.", ".$per_page;

       $data['paginator'] = New Paginator($total_items,$per_page,$path);

       $data['items'] = $db->makeQuery($query);

       return  $data;
    }

}