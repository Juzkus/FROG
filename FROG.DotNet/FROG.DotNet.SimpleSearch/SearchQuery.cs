using System;
using System.Collections.Generic;
using System.Text;

namespace FROG.DotNet.SimpleSearch
{
    public class SearchQuery
    {
        public string SearchHandle { get; set; }
        List<SearchCriteria> SearchCriteria { get; set; }
    }
}
