
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Http\Requests\InquiryController\StoreRequest;

class InquiryController extends Controller
{

    // 登録画面
    public function create() : View
    {
        return view('inquiry.create');
    }

    // お問い合わせ内容登録処理
    public function store(StoreRequest $request) : View
    {
        // お問い合わせ内容を登録する処理

        return view('inquiry.thanks');
    }
}
