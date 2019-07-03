using System;
using System.Collections.Generic;
using FROG.DotNet.SimpleSearch.IO;

namespace FROG.DotNet.SimpleSearch
{
    class Program
    {
        /*
         Salutations! The process begins here (as far as this code is concerned).
         */
        static void Main(string[] args)
        {
            var props = PropertyParser.GetPropertiesFromFile(@"./Resources/local_search.props", '=');
            LOG("FROG.DotNet.SimpleSearch Process Starting.");

            var search = new FileSystemSearchService();
            var searchCriteria = new List<SearchCriteria>();

            searchCriteria.Add(new SearchCriteria { Property = "fileName", CompareType = SearchComparison.CONTAINS, Value = "Result" });

            var results = search.Search(searchCriteria);

            DEBUG_LOG(results);

            // insert breakpoint
            var x = 1;
        }

        static void maybe_main()
        {
            var props = PropertyParser.GetPropertiesFromFile(@"./Resources/local_search.props", '=');

            LOG("FROG.DotNet.SimpleSearch Process Starting.");

            // open I/O pipes (db, named pipes).
            LOG("FROG.DotNet.SimpleSearch Connecting Pipes I/O (DB, Named Pipes).");
            var pipe = new Pipe("FROG.DotNet.SimpleSearch", PipeType.SERVER, null);
            var message = pipe.GetMessage();

            // load inverted index into memory.
            LOG("FROG.DotNet.SimpleSearch Loading Inverted Index.");

            // initialize API services.
            LOG("FROG.DotNet.SimpleSearch Initializing API Services.");

            // message/queue
            LOG("FROG.DotNet.SimpleSearch Ready.");
        }

        static void DEBUG_LOG(List<SearchResult> searchResults)
        {
            foreach (var searchResult in searchResults)
            {
                Console.WriteLine(searchResult.Title);
            }
        }

        static void LOG(string message)
        {
            var date = DateTime.Now.ToString();
            Console.WriteLine(string.Format("{0}: {1}", date, message));
        }
    }
}
