<h3>Setup</h3>
<p>1. Place ajax.php in your application/libraries folder.</p>
<p>2. Add the following code to your application/config/constants.php file:</p>
<pre>
<code>
/*
|--------------------------------------------------------------------------
| Detect Ajax Requests
|--------------------------------------------------------------------------
|
| This constant is used to determine whether the request is an AJAX request, or a standard HTTP request.
|
*/
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
</code>
</pre>
<p>3. Place encode_xml_helper.php in your application/helpers folder (or use your own xml encoder) if you plan on sending back xml.</p>
<p>4. Place test.php in your application/controllers folder and	 ajax_test_view.php in your application/views/test folder.</p>


<h3>Basic Use</h3>
<p>Example controller (test.php)</p>
<pre>
<code>
class Test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('test/ajax_test_view');
	}

	function get_something()
	{
		$this->load->library('ajax');

		$arr['something'] = 'Something Good';

		if ($this->input->post('something_id') == '2')
		{
			$arr['something'] = 'Something Better';
		}

		$this->ajax->output_ajax($arr);
	}
}
</code>
</pre>

<p>The example view: ajax_test_view.php</p>


<h3>Options</h3>
<p>You can limit access to HTTP_X_REQUESTED_WITH requests (ajax requests) two ways. The first is by setting the third parameter of output_ajax to TRUE. Note: this the default. If you try to access your ajax url site_url('/test/get_something') via a web browser you will receive the error message: 'Invalid Request Origin'. If you set it to FALSE you will be able to see the data you are returing in your web browser if you are returing text or html, the json and xml types will prompt a file download.</p>
<pre>
<code>
function get_something()
{
	$this->load->library('ajax');
	$arr['something'] = 'Something Good';
   
	if ($this->input->post('something_id') == '2')
	{
		$arr['something'] = 'Something Better';
	}

	$this->ajax->output_ajax($arr, 'json', TRUE);	// Only send a response if this is an ajax request
}
</code>
</pre>

<p>The above method still allows the code in your controler to be executed which is fine for retreving data. If you would like to exit the controler method before any code is executied when this is not an ajax request you can use the non_ajax() method to test it.</p>
<pre>
<code>
function get_something()
{
	$this->load->library('ajax');
	if ($this->ajax->non_ajax(FALSE)) return;	// Exit the controler if this is not an ajax request
	// Optionaly passing TRUE will output a 403 HTTP status code with a text/plain message reading "Invalid Request Origin"
	// if ($this->ajax->non_ajax(TRUE)) return; // Exit the controler if this is not an ajax request

	$arr['something'] = 'Something Good';

	if ($this->input->post('something_id') == '2')
	{
		$arr['something'] = 'Something Better';
	}

   $this->ajax->output_ajax($arr);
}
</code>
</pre>


<p>Tested with CodeIgniter 2.2.0</p>
