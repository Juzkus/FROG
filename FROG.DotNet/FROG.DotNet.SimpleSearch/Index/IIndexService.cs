using System;
using System.Collections.Generic;
using System.Text;

namespace FROG.DotNet.SimpleSearch.Index
{
    public interface IIndexService
    {
        string PerformSearchAndGetHandle(string query);
        List<SearchResult> GetSearchResults(string handle);
    }
}
